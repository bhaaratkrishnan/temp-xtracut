<?php

class Hostinger_Ai_Assistant_Amplitude {
	const AMPLITUDE_ENDPOINT = '/v3/wordpress/plugin/trigger-event';
	const PLUGIN_INSTALL_TYPE = 'hostinger_ai_plugin_installation_type';
	private $config_handler;
	private $client;

	public function __construct() {
		$this->config_handler = new Hostinger_Ai_Assistant_Config();
		$this->client         = new Hostinger_Ai_Assistant_Requests_Client( $this->config_handler->get_config_value( 'base_rest_api', HOSTINGER_AI_ASSISTANT_REST_URI ), [
			'X-Hpanel-Order-Token' => Hostinger_Ai_Assistant_Helper::get_api_token()
		] );
		add_action( 'transition_post_status', [ $this, 'track_published_post' ], 10, 3 );
		add_action( 'activate_hostinger_ai_assistant', [ $this, 'track_manually_installed_plugin' ], 10, 3 );
		add_action( 'init', [ $this, 'track_installed_plugin' ], 10, 3 );
	}

	private function send_request( string $endpoint, array $params ): void {

		$params   = [ 'params' => $params ];
		$response = $this->client->post( $endpoint, $params );

		if ( is_wp_error( $response ) ) {
			error_log( $response );
		}
	}

	public function ai_content_created(): void {
		$endpoint = self::AMPLITUDE_ENDPOINT;
		$params   = array(
			'action' => Hostinger_Ai_Assistant_Amplitude_Actions::AI_CONTENT_CREATE
		);

		$this->send_request( $endpoint, $params );
	}

	public function ai_content_saved( string $post_type, int $post_id ): void {
		$endpoint = self::AMPLITUDE_ENDPOINT;
		$params   = array(
			'action'       => Hostinger_Ai_Assistant_Amplitude_Actions::AI_CONTENT_CREATED,
			'content_type' => $post_type,
			'content_id'   => $post_id,
		);

		$this->send_request( $endpoint, $params );
	}

	public function ai_content_published( string $post_type, int $post_id ): void {
		$endpoint = self::AMPLITUDE_ENDPOINT;
		$params   = array(
			'action'       => Hostinger_Ai_Assistant_Amplitude_Actions::AI_CONTENT_CREATED_PUBLISHED,
			'content_type' => $post_type,
			'content_id'   => $post_id,
		);

		$this->send_request( $endpoint, $params );
	}

	public function track_published_post( string $new_status, string $old_status, WP_Post $post ): void {
		$post_id              = $post->ID;
		$ai_content_generated = get_post_meta( $post_id, 'hostinger_ai_generated', true );
		static $is_action_executed = array();

		if ( isset( $is_action_executed[ $post_id ] ) ) {
			return;
		}

		if ( ( 'draft' === $old_status || 'auto-draft' === $old_status ) && $new_status === 'publish' ) {

			if ( $ai_content_generated && ! wp_is_post_revision( $post_id ) ) {
				$post_type = get_post_type( $post_id );
				$this->ai_content_published( $post_type, $post_id );
				$is_action_executed[ $post_id ] = true;
			}

		}
	}

	public function track_manually_installed_plugin(): void {
		$endpoint = self::AMPLITUDE_ENDPOINT;
		$plugin_install_type = get_option( self::PLUGIN_INSTALL_TYPE );
		static $is_action_executed = false;

		if ( $is_action_executed ) {
			return;
		}

		if ( $plugin_install_type ) {
			return;
		}

		$params = array(
			'action'         => Hostinger_Ai_Assistant_Amplitude_Actions::AI_PLUGIN_INSTALLED,
			'location'       => 'wordpress',
			'plugin_name'    => basename( plugin_dir_path( dirname( __FILE__, 2 ) ) ),
			'plugin_version' => HOSTINGER_AI_ASSISTANT_VERSION,
		);

		$is_action_executed = true;
		$this->send_request( $endpoint, $params );

	}

	public function track_installed_plugin(): void {
		$endpoint            = self::AMPLITUDE_ENDPOINT;
		$plugin_install_type = get_option( self::PLUGIN_INSTALL_TYPE );

		static $is_action_executed = false;

		if ( $is_action_executed ) {
			return;
		}

		if ( ! $plugin_install_type ) {
			return;
		}

		$params = array(
			'action'         => Hostinger_Ai_Assistant_Amplitude_Actions::AI_PLUGIN_INSTALLED,
			'location'       => $plugin_install_type,
			'plugin_name'    => basename( plugin_dir_path( dirname( __FILE__, 2 ) ) ),
			'plugin_version' => HOSTINGER_AI_ASSISTANT_VERSION,
		);

		$is_action_executed = true;
		$this->send_request( $endpoint, $params );
		delete_option( self::PLUGIN_INSTALL_TYPE );

	}

}

new Hostinger_Ai_Assistant_Amplitude();
