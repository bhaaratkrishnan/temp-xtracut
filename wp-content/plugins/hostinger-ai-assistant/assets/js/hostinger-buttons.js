document.addEventListener("DOMContentLoaded",(function(){var t="hostinger_add_new_ai_post",e=wp.i18n.__("Add New with AI","hostinger-ai-assistant"),n=hostingerAiAssistant.tabUrl;if(n){var o='<a id="'.concat(t,'" class="components-button is-primary" href="').concat(n,'" >').concat(e,"</a>"),a=document.getElementById("editor");a&&wp.data.subscribe((function(){setTimeout((function(){if(!document.getElementById(t)){var e=a.querySelector(".edit-post-header__toolbar");e instanceof HTMLElement&&e.insertAdjacentHTML("beforeend",o)}}),1)}))}}));