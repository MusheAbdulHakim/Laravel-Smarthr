window.ThreadTemplates = (function () {
    var methods = {
        youtubeRegex : function(){
            return /https?:\/\/(?:[0-9A-Z-]+\.)?(?:youtu\.be\/|youtube(?:-nocookie)?\.com\S*?[^\w\s-])([\w-]{11})(?=[^\w-]|$)(?![?=&+%\w.-]*(?:['"][^<>]*>|<\/a>))[?=&+%\w.-]*/ig
        },
        giphyRegex : function(){
            return /https?:\/\/(?:i\.giphy\.com\/|media\.giphy\.com\/media|giphy\.com\/gifs\/(?:\S*-|[^-])|media?[0-9A-Z-]\.giphy\.com\/media\/)([^- /\n]+)(?:\.\bgif\b|\b\/giphy\.gif\b|\n|(?=\s|$))/ig
        },
        makeLinks : function(body){
            return autolinker.link(body)
        },
        makeYoutube : function(body){
            let html = '<div class="embed-responsive embed-responsive-16by9 my-2"><iframe allowfullscreen class="embed-responsive-item" src="https://www.youtube.com/embed/$1"></iframe></div>';
            if(Messenger.common().mobile){
                html = '<a class="youtube_thumb_view" target="_blank" href="https://www.youtube.com/watch?v=$1">' +
                    '<img class="msg_image NS img-fluid" src="https://img.youtube.com/vi/$1/hqdefault.jpg" />' +
                    '<div class="h3 spinner-grow text-info" style="width: 4rem; height: 4rem;" role="status"><span class="sr-only">loading...</span></div><span class="yt_logo_place"></span>'+
                    '</a>';
            }
            return body.replace(methods.youtubeRegex(), html);
        },
        makeGiphy : function(body){
            let html = '<div class="col-12 p-1">' +
                '<a target="_blank" href="https://media.giphy.com/media/$1/giphy.gif">' +
                '<img class="msg_image NS img-fluid" src="https://media.giphy.com/media/$1/giphy.gif" />' +
                '<div class="h3 spinner-grow text-info" style="width: 4rem; height: 4rem;" role="status"><span class="sr-only">loading...</span></div>'+
                '</a>' +
                '</div>';
            return body.replace(methods.giphyRegex(), html);
        },
        format_message_body : function(body, skipExtra){
            if(skipExtra === true){
                return Messenger.format().shortcodeToImage(body)
            }
            return methods.makeLinks(
                methods.makeGiphy(
                    methods.makeYoutube(
                        Messenger.format().shortcodeToImage(body)
                    )
                )
            );
        },
    },
    templates = {
        archive_thread_warning : function(data){
            if(!data.group){
                return 'Delete the conversation between you and <strong>'+data.name+'</strong>?'+
                       '<div class="card mt-3"><div class="card-body bg-warning shadow rounded"><h5>All '+data.messages_count+
                       ' messages between you and '+data.name+' will be removed. Any new messages will create a new conversation</h5></div></div>'
            }
            return 'Delete <strong>'+data.name+'</strong>?'+
                   '<div class="card mt-3"><div class="card-body bg-warning shadow rounded"><h5>All '+data.messages_count+
                   ' messages and '+data.participants_count+' participants will be removed. This group will no longer be accessible</h5></div></div>'
        },
        messages_disabled_overlay : function(){
            return '<div id="messaging_disabled_overlay" class="disabled-message-overlay rounded text-center">' +
                '<div class="mt-3 pt-1 h4"><span class="badge badge-pill badge-light"><i class="fas fa-comment-slash"></i> Messaging Disabled</span></div> ' +
                '</div>'
        },
        empty_base : function(){
            return '<div class="container h-100">\n' +
                '    <div class="row align-items-end h-100">\n' +
                '        <div class="col-12 text-center mb-5">\n' +
                '            <button data-bs-toggle="tooltip" title="Search Profiles" data-bs-placement="top" onclick="ThreadManager.load().search()" class="btn btn-outline-dark btn-circle btn-circle-xl mx-4 my-2"><i class="fas fa-search fa-3x"></i></button>\n' +
                '            <button data-bs-toggle="tooltip" title="Create Group" data-bs-placement="top" onclick="ThreadManager.load().createGroup()" class="btn btn-outline-success btn-circle btn-circle-xl mx-4 my-2"><i class="fas fa-edit fa-3x"></i></button>\n' +
                '            <button data-bs-toggle="tooltip" title="Friends" data-bs-placement="top" onclick="ThreadManager.load().contacts()" class="btn btn-outline-info btn-circle btn-circle-xl mx-4 my-2"><i class="fas fa-user-friends fa-3x"></i></button>\n' +
                '            <button data-bs-toggle="tooltip" title="Messenger Settings" data-bs-placement="top" onclick="MessengerSettings.show()" class="btn btn-outline-primary btn-circle btn-circle-xl mx-4 my-2"><i class="fas fa-cog fa-3x"></i></button>\n' +
                '        </div>\n' +
                '    </div>\n' +
                '</div>'
        },
        send_msg_btn : function(emoji){
            return `<div id="inline_send_msg_btn">
                <button class="btn btn-custom" type="button" title="Click to send or press enter" 
                onclick="${(ThreadManager.state().type === 3 ? 'ThreadManager.newForms().newPrivate(0);' : 'ThreadManager.send();')} return false;"><i class="fa-solid fa-paper-plane"></i></button>
            </div>`
        },
        socket_error : function(){
            return '<div class="my-2 alert alert-danger text-danger socket-error-main text-center"><span class="spinner-grow spinner-grow-sm"></span> Connection error, messages may be delayed</div>';
        },
        thread_socket_error : function(group){
            return `
            <span class="thread_error_area NS">
            <button data-trigger="focus" data-bs-toggle="popover" data-bs-title="Connection Error" data-content="You may be experiencing connection issues. Messenger may be delayed while we attempt to connect" data-bs-placement="bottom"
            class="${(group ? 'mr-1' : '')} thread_error_btn glowing_warning_btn btn btn-lg btn-warning pt-1 pb-0 px-2"><i class="fas fa-exclamation-triangle"></i></button>
            </span>
            `
        },
        seen_by : function(id){
            return `
            <div class="chat-avatar">
                <div id="seen-by_${id}" class="avatar seen-by">
                </div>
            </div>
            `
        },
        bobble_head : function(data, bottom){
            return `<div class="bobble_head_${data.owner_id}">
                        <div class="chat-avatar">
                            <a ${(data.owner.route ? '' : 'onclick="return false;" href="'+(data.owner.route ? data.owner.route : '#')+'" target="_blank"')} class="avatar">
                                <img src="${data.owner.avatar.sm}" class="${(bottom && (!data.in_chat || [0,2].includes(data.owner.options.online_status)) ? "bobble-image-away" : "")}" 
                                title="${((data.typing || bottom) ? Messenger.format().escapeHtml(data.owner.name) : "Seen by "+Messenger.format().escapeHtml(data.owner.name))}" alt="${Messenger.format().escapeHtml(data.owner.name)}">
                            </a>
                            <div class="d-inline bobble-typing">${(data.typing ? templates.typing_elipsis(data.owner_id) : '')}</div>
                        </div>
                    </div>
            `
        },
        bot_typing_bobble_head : function(bot){
            return '<div class="bobble-head-item bot-bobble-head d-inline bot_typing_bobble_head_'+bot.id+'"><img class="rounded-circle bobble-image" src="'+bot.avatar+'" ' +
                'title="'+Messenger.format().escapeHtml(bot.name)+'" />' +
                '<div class="d-inline bobble-typing"><div class="typing-ellipsis"><div><i class="fas fa-circle"></i></div><div><i class="fas fa-circle"></i></div><div><i class="fas fa-circle"></i></div></div></div></div>';
        },
        typing_elipsis : function(id){
            return `<div id="typing_${id}" class="d-flex typing-text">
                        <div><i class="fas fa-circle"></i></div>
                        <div><i class="fas fa-circle"></i></div>
                        <div><i class="fas fa-circle"></i></div>
                    </div>`
        },
        loader : function(){
            return '<div class="col-12 mt-5 text-center"><div class="spinner-grow spinner-grow-sm text-primary" role="status"></div></div>'
        },
        thread_body : function(data){
            if(data.resources.latest_message){
                switch(data.resources.latest_message.type){
                    case 1:
                        return '<em>'+data.resources.latest_message.owner.name+'</em> : <i class="far fa-image"></i> Sent an image';
                    case 2:
                        return '<em>'+data.resources.latest_message.owner.name+'</em> : <i class="fas fa-file-download"></i> Sent a file';
                    case 3:
                        return '<em>'+data.resources.latest_message.owner.name+'</em> : <i class="fas fa-music"></i> Sent an audio file';
                    case 4:
                        return '<em>'+data.resources.latest_message.owner.name+'</em> : <i class="fas fa-video"></i> Sent a video';
                    default:
                        return '<em>'+data.resources.latest_message.owner.name+'</em> : ' + Messenger.format().shortcodeToImage(data.resources.latest_message.body)
                }
            }
            return '';
        },
        thread_highlight : function(data){
            if(data.locked){
                return 'alert-danger'
            }
            if(data.has_call){
                if(data.resources.active_call.options.in_call){
                    return 'alert-success'
                }
                return 'alert-dark'
            }
            if(data.unread && data.unread_count > 0){
                return 'alert-info'
            }
            return ''
        },
        thread_status : function(data){
            if(data.locked){
                return ' <span class="shadow-sm badge badge-pill badge-danger">Locked <i class="fas fa-lock"></i></span>'
            }
            if(data.options.muted){
                return ' <span class="shadow-sm badge badge-pill badge-secondary">Muted <i class="fas fa-volume-mute"></i></span>'
            }
            if(data.pending){
                return ' <span class="shadow-sm badge badge-pill badge-info">Pending <i class="fas fa-hourglass"></i></span>'
            }
            if(data.has_call){
                let details = 'Call <i class="fas fa-video"></i>';
                if(data.resources.active_call.options.in_call){
                    return ' <span class="shadow-sm badge badge-pill badge-danger">'+details+'</span>'
                }
                if(data.resources.active_call.options.left_call){
                    return ' <span class="shadow-sm badge badge-pill badge-success">'+details+'</span>'
                }
                return ' <span class="shadow-sm badge badge-pill badge-warning">'+details+'</span>'
            }
            if(data.unread && data.unread_count > 0){
                return ' <span class="shadow-sm badge badge-pill badge-primary">'+(data.unread_count >= 50 ? '50+' : data.unread_count)+' <i class="fas fa-comment-dots"></i></span>'
            }
            return ''
        },
        thread_logs : function(data){
            let html = '';
            data.data.forEach(function (message) {
                html += '<span class="badge badge-pill badge-light">'+Messenger.format().makeHumanTime(message.created_at)+'</span>';
                html += templates.system_message(message, true)
            });
            if(!data.meta.final_page){
                html += '<div id="log_paginate_btn" class="col-12 text-center mt-4"><hr>' +
                    '<button onclick="ThreadManager.load().threadLogs(true, \''+data.meta.next_page_id+'\')" type="button" class="btn btn-primary">Load More <i class="fas fa-chevron-circle-down"></i></button>' +
                    '</div>';
            }
            return html
        },
        thread_images : function(data){
            let html = '';
            data.data.forEach(function (message) {
                html += templates.images_message(message)
            });
            if(!data.meta.final_page){
                html += '<div id="image_paginate_btn" class="col-12 text-center mt-4"><hr>' +
                    '<button onclick="ThreadManager.load().threadImages(true, \''+data.meta.next_page_id+'\')" type="button" class="btn btn-primary">Load More <i class="fas fa-chevron-circle-down"></i></button>' +
                    '</div>';
            }
            return html
        },
        thread_documents : function(start, data){
            let html = '';
            if(start){
                html += '<div class="inbox mx-n2"><ul id="documents_history" class="inbox messages-list">';
            }
            data.data.forEach(function (message) {
                html += templates.document_item(message)
            });
            if(start){
                html += '</ul></div>';
            }
            if(!data.meta.final_page){
                html += '<div id="document_paginate_btn" class="col-12 text-center mt-4"><hr>' +
                    '<button onclick="ThreadManager.load().threadDocuments(true, \''+data.meta.next_page_id+'\')" type="button" class="btn btn-primary">Load More <i class="fas fa-arrow-alt-circle-down"></i></button>' +
                    '</div>';
            }
            return html
        },
        thread_audio : function(start, data){
            let html = '';
            if(start){
                html += '<div class="inbox mx-n2"><ul id="audio_history" class="inbox messages-list">';
            }
            data.data.forEach(function (message) {
                html += templates.audio_item(message)
            });
            if(start){
                html += '</ul></div>';
            }
            if(!data.meta.final_page){
                html += '<div id="audio_paginate_btn" class="col-12 text-center mt-4"><hr>' +
                    '<button onclick="ThreadManager.load().threadAudio(true, \''+data.meta.next_page_id+'\')" type="button" class="btn btn-primary">Load More <i class="fas fa-arrow-alt-circle-down"></i></button>' +
                    '</div>';
            }
            return html
        },
        thread_videos : function(start, data){
            let html = '';
            if(start){
                html += '<div class="inbox mx-n2"><ul id="video_history" class="inbox messages-list">';
            }
            data.data.forEach(function (message) {
                html += templates.video_item(message)
            });
            if(start){
                html += '</ul></div>';
            }
            if(!data.meta.final_page){
                html += '<div id="video_paginate_btn" class="col-12 text-center mt-4"><hr>' +
                    '<button onclick="ThreadManager.load().threadVideos(true, \''+data.meta.next_page_id+'\')" type="button" class="btn btn-primary">Load More <i class="fas fa-arrow-alt-circle-down"></i></button>' +
                    '</div>';
            }
            return html
        },
        message_edit_history : function(data){
            let html = '<div class="mx-n2"><ul id="edit_history">';
            data.forEach(function (message) {
                html += templates.message_edit_item(message)
            });
            html += '</ul></div>';
            return html
        },
        message_edit_item : function(data){
            return '<li title="Edited on '+Messenger.format().makeHumanTime(data.edited_at)+'" class="thread_list_item mb-2">' +
                methods.format_message_body(data.body, true) +
                '</li>'
        },
        document_item : function(data){
            return '<li title="'+Messenger.format().escapeHtml(data.owner.name)+' on '+Messenger.format().makeHumanTime(data.created_at)+'" class="thread_list_item mb-2">' +
                '<div class="thread-list-status"><span class="shadow-sm badge badge-pill badge-success">Document <i class="fas fa-file-alt"></i></span></div> '+
                '<a target="_blank" href="'+data.document+'">' +
                '<div class="media"><div class="media-left media-middle"><img src="'+data.owner.avatar.sm+'" class="media-object rounded-circle thread-list-avatar avatar-is-offline" /></div>' +
                '<div class="media-body thread_body_li"><div class="header d-inline"><small><div class="float-right date"><time class="timeago" datetime="'+data.created_at+'">'+Messenger.format().makeTimeAgo(data.created_at)+'</time></div></small>' +
                '<div class="from fw-bold">'+data.owner.name+'</div></div><div class="description"><em><i class="fas fa-file-download"></i> '+data.body+'</em></div></div></div></a></li>'
        },
        audio_item : function(data){
            return '<li title="'+Messenger.format().escapeHtml(data.owner.name)+' on '+Messenger.format().makeHumanTime(data.created_at)+'" class="thread_list_item mb-2">' +
                '<div class="thread-list-status"><span class="shadow-sm badge badge-pill badge-success">Audio <i class="fas fa-music"></i></span></div> '+
                '<a target="_blank" href="'+data.audio+'">' +
                '<div class="media"><div class="media-left media-middle"><img src="'+data.owner.avatar.sm+'" class="media-object rounded-circle thread-list-avatar avatar-is-offline" /></div>' +
                '<div class="media-body thread_body_li"><div class="header d-inline"><small><div class="float-right date"><time class="timeago" datetime="'+data.created_at+'">'+Messenger.format().makeTimeAgo(data.created_at)+'</time></div></small>' +
                '<div class="from fw-bold">'+data.owner.name+'</div></div><div class="description"><em><i class="fas fa-music"></i> '+data.body+'</em></div></div></div></a>' +
                '<div class="col-12 text-center"><audio controls preload="none" class="message-audio-player"><source src="'+data.audio+'?stream=true"></audio></div>' +
                '</li>'
        },
        video_item : function(data){
            return '<li title="'+Messenger.format().escapeHtml(data.owner.name)+' on '+Messenger.format().makeHumanTime(data.created_at)+'" class="thread_list_item mb-2">' +
                '<div class="thread-list-status"><span class="shadow-sm badge badge-pill badge-success">Video <i class="fas fa-video"></i></span></div> '+
                '<a target="_blank" href="'+data.video+'">' +
                '<div class="media"><div class="media-left media-middle"><img src="'+data.owner.avatar.sm+'" class="media-object rounded-circle thread-list-avatar avatar-is-offline" /></div>' +
                '<div class="media-body thread_body_li"><div class="header d-inline"><small><div class="float-right date"><time class="timeago" datetime="'+data.created_at+'">'+Messenger.format().makeTimeAgo(data.created_at)+'</time></div></small>' +
                '<div class="from fw-bold">'+data.owner.name+'</div></div><div class="description"><em><i class="fas fa-video"></i> '+data.body+'</em></div></div></div></a>' +
                '<div class="col-12 text-center"><div class="embed-responsive embed-responsive-16by9 my-3"><video class="embed-responsive-item" controls preload="metadata"><source src="'+data.video+'?stream=true"></video></div></div>' +
                '</li>'
        },
        messenger_search_friend : function(profile){
            switch(profile.options.friend_status){
                case 0: return '';
                case 1: return ' <span class="shadow-sm badge badge-pill badge-success"><i class="fas fa-user"></i> Friend</span>';
                case 2: return ' <span class="shadow-sm badge badge-pill badge-info"><i class="fas fa-user-plus"></i> Sent request</span>';
                case 3: return ' <span class="shadow-sm badge badge-pill badge-primary"><i class="fas fa-user-friends"></i> Pending request</span>';
            }
            return ''
        },
        messenger_search : function(profile){
            return '<li title="'+Messenger.format().escapeHtml(profile.name)+'" class="thread_list_item">' +
                '<a onclick="ThreadManager.load().createPrivate({id : \''+profile.provider_id+'\', alias : \''+profile.provider_alias+'\'}); return false;" href="#">' +
                '<div class="media"><div class="media-left media-middle"><img data-src="'+profile.avatar.sm+'" class="lazy media-object rounded-circle thread-list-avatar avatar-is-'+(profile.options.online_status === 1
                    ? "online" : profile.options.online_status === 2 ? "away" : "offline")+'" /></div>' +
                '<div class="media-body thread_body_li"><div class="header d-inline"><small><div class="d-none d-sm-block float-right">' +
                '<span class="badge badge-light text-capitalize"><i class="fas fa-restroom"></i> '+profile.provider_alias+'</span></div></small>' +
                '<div class="from h5 fw-bold">'+profile.name+'</div></div><div class="description mt-n2">' +
                templates.messenger_search_friend(profile) +
                '</div></div></div></a></li>'
        },
        private_thread : function(data, selected, special){
            return '<li title="'+Messenger.format().escapeHtml(data.name)+'" id="thread_list_'+data.id+'" class="thread_list_item '+(selected ? "alert-warning shadow-sm rounded" : "")+' '+templates.thread_highlight(data)+'">' +
                '<div class="thread-list-status">'+templates.thread_status(data)+'</div> '+
                '<a '+(special ? '' : 'onclick="ThreadManager.load().initiate_thread({thread_id : \''+data.id+'\'}); return false;"')+' href="'+Messenger.common().WEB+'/'+data.id+'">' +
                '<div class="media"><div class="media-left media-middle"><img src="'+data.avatar.sm+'" class="media-object rounded-circle thread-list-avatar avatar-is-'+(data.resources.recipient.options.online_status === 1
                    ? "online" : data.resources.recipient.options.online_status === 2 ? "away" : "offline")+'" /></div>' +
                '<div class="media-body thread_body_li"><div class="header d-inline"><small><div class="float-right date"><time class="timeago" datetime="'+data.updated_at+'">'+Messenger.format().makeTimeAgo(data.updated_at)+'</time></div></small>' +
                '<div class="from fw-bold">'+data.name+'</div></div><div class="description">' +
                templates.thread_body(data) +
                '</div></div></div></a></li>'
        },
        group_thread : function(data, selected, special){
            return '<li title="'+Messenger.format().escapeHtml(data.name)+'" id="thread_list_'+data.id+'" class="thread_list_item '+(selected ? "alert-warning shadow-sm rounded" : "")+' '+templates.thread_highlight(data)+'">' +
                '<div class="thread-list-status">'+templates.thread_status(data)+'</div> '+
                '<a '+(special ? '' : 'onclick="ThreadManager.load().initiate_thread({thread_id : \''+data.id+'\'}); return false;"')+' href="'+Messenger.common().WEB+'/'+data.id+'">' +
                '<div class="media"><div class="media-left media-middle"><img src="'+data.avatar.sm+'" class="show_group_avatar_'+data.id+' media-object rounded-circle thread-list-avatar thread-group-avatar '+(selected ? "avatar-is-online" : "avatar-is-offline")+'" /></div>' +
                '<div class="media-body thread_body_li"><div class="header d-inline"><small><div class="float-right date"><time class="timeago" datetime="'+data.updated_at+'">'+Messenger.format().makeTimeAgo(data.updated_at)+'</time></div></small>' +
                '<div class="from fw-bold">'+data.name+'</div></div><div class="description">' +
                templates.thread_body(data) +
                '</div></div></div></a></li>'
        },
        message_body : function(data, pending, reply, nolink){
            if(pending === true){
                switch(data.type){
                    case 1:
                    case 2:
                    case 3:
                    case 4:
                        return '<div class="h3 spinner-grow text-danger" style="width: 4rem; height: 4rem;" role="status">\n' +
                                '  <span class="sr-only">Uploading...</span>\n' +
                                '</div>';
                    default:
                        return Messenger.format().shortcodeToImage(data.body)
                }
            }
            if(reply === true){
                switch(data.type){
                    case 1:
                        return nolink === true ?
                            '<img height="100" src="'+data.image.md+'" />' : '<a target="_blank" href="'+data.image.lg+'"><img height="100" class="msg_image NS" src="'+data.image.md+'" /></a>';
                    case 2:
                        return nolink === true ? '<i class="fas fa-file-download"></i> '+data.body : '<a href="'+data.document+'" target="_blank"><i class="fas fa-file-download"></i> '+data.body+'</a>';
                    case 3:
                        return nolink === true ? '<i class="fas fa-music"></i> '+data.body :  '<a href="'+data.audio+'" target="_blank"><i class="fas fa-music"></i> '+data.body+'</a>';
                    case 4:
                        return nolink === true ? '<i class="fas fa-video"></i> '+data.body :  '<a href="'+data.video+'" target="_blank"><i class="fas fa-video"></i> '+data.body+'</a>';
                    default:
                        return methods.format_message_body(data.body, true);
                }
            }
            switch(data.type){
                case 1:
                    return '<a target="_blank" href="'+data.image.lg+'">' +
                               '<img class="msg_image NS img-fluid" src="'+data.image.md+'" />' +
                               '<div class="h3 spinner-grow text-info" style="width: 4rem; height: 4rem;" role="status"><span class="sr-only">loading...</span></div>'+
                           '</a>';
                case 2:
                    return '<a href="'+data.document+'" target="_blank"><i class="fas fa-file-download"></i> '+data.body+'</a>';
                case 3:
                    let audio = '<audio controls preload="none" class="message-audio-player"><source src="'+data.audio+'?stream=true"></audio>';
                    if(data.extra !== null && data.extra.audio_message){
                        return '<a href="'+data.audio+'" target="_blank"><i class="fas fa-volume-up"></i> Audio Message</a><hr>' +audio;
                    }
                    return '<a href="'+data.audio+'" target="_blank"><i class="fas fa-volume-up"></i> '+data.body+'</a><hr>' +audio;
                case 4:
                    let video = '<div class="embed-responsive embed-responsive-16by9 my-2"><video class="embed-responsive-item" controls preload="metadata"><source src="'+data.video+'?stream=true"></video></div>';
                    return '<a href="'+data.video+'" target="_blank"><i class="fas fa-video"></i> '+data.body+'</a><hr>' +video;
                default:
                    let body = methods.format_message_body(data.body);

                    return data.edited ? body + ' <span onclick="ThreadManager.load().messageEdits(\''+data.edited_history_route+'\')" class="pointer_area"><small class="fw-bold text-muted" title="Edited on '+Messenger.format().makeHumanTime(data.updated_at)+'">(edited)</small></span>' : body;
            }
        },
        message_options : function(data, grouped){

            if(!ThreadManager.state().thread_lockout){
                return `<div class="chat-action-btns">
                            <ul>
                                <li>
                                    <a href="#" class="share-msg" title="Share" onclick="EmojiPicker.addReaction('${data.id}')">
                                        <i data-bs-toggle="tooltip" data-bs-title="React" class="fas fa-grin"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="share-msg" title="Share" onclick="ThreadManager.reply({id : '${data.id}'})">
                                        <i data-bs-toggle="tooltip" data-bs-title="Reply" class="fas fa-reply"></i>
                                    </a>
                                </li>
                                <li><a onclick="ThreadManager.archive().Message({id : '${data.id}'}); return false;" class="del-msg" href="#"><i class="fa-regular fa-trash-can"></i></a></li>
                                <li class="nav-item dropdown dropdown-action">
                                    <a aria-expanded="false" data-bs-toggle="dropdown" class="dropdown-toggle"
                                        href="#"><i class="fa-solid fa-ellipsis-v"></i>
                                    </a>
                                    <div id="msg_options_${data.id}"  class="dropdown-menu dropdown-menu-right">
                                        ${(data.type === 0
                                            ? '<a onclick="ThreadManager.editMessage({id : '+data.id+'}); return false;" class="dropdown-item" href="#"><i class="fa-solid fa-pen"></i> Edit</a>'
                                            : '')}
                                            <a onclick="EmojiPicker.addReaction('${data.id}'); return false;" class="dropdown-item" href="#"><i class="fa-solid fa-grin"></i> React</a>
                                            <a onclick="ThreadManager.reply({id : '${data.id}'}); return false;" class="dropdown-item" href="#"><i class="fa-solid fa-reply"></i> Reply</a>
                                            <a onclick="ThreadManager.load().messageReactions('${data.id}'); return false;" class="dropdown-item" href="#"><i class="fas fa-grin-tongue"></i> View Reactions</a>
                                            ${(ThreadManager.state().thread_admin ? 
                                                '<a onclick="ThreadManager.archive().Message({id : '+data.id+'}); return false;" class="dropdown-item" href="#"><i class="fas fa-trash"></i> Delete</a>'
                                            : '')}
                                    </div>
                                </li>
                            </ul>
                        </div>`
            }

        },
        my_message_options: function(data, grouped){
            if(!ThreadManager.state().thread_lockout){
                return `<div class="chat-action-btns">
                            <ul>
                                <li>
                                    <a href="#" class="share-msg" title="Share" onclick="EmojiPicker.addReaction('${data.id}')">
                                        <i data-bs-toggle="tooltip" data-bs-title="React" class="fas fa-grin"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="share-msg" title="Share" onclick="ThreadManager.reply({id : '${data.id}'})">
                                        <i data-bs-toggle="tooltip" data-bs-title="Reply" class="fas fa-reply"></i>
                                    </a>
                                </li>
                                <li><a onclick="ThreadManager.archive().Message({id : '${data.id}'}); return false;" class="del-msg" href="#"><i class="fa-regular fa-trash-can"></i></a></li>
                                <li class="nav-item dropdown dropdown-action">
                                    <a aria-expanded="false" data-bs-toggle="dropdown" class="dropdown-toggle"
                                        href="#"><i class="fa-solid fa-ellipsis-v"></i>
                                    </a>
                                    <div id="msg_options_${data.id}"  class="dropdown-menu dropdown-menu-right">
                                        ${(data.type === 0
                                            ? '<a onclick="ThreadManager.editMessage({id : '+data.id+'}); return false;" class="dropdown-item" href="#"><i class="fa-solid fa-pen"></i> Edit</a>'
                                            : '')}
                                            <a onclick="EmojiPicker.addReaction('${data.id}'); return false;" class="dropdown-item" href="#"><i class="fa-solid fa-grin"></i> React</a>
                                            <a onclick="ThreadManager.reply({id : '${data.id}'}); return false;" class="dropdown-item" href="#"><i class="fa-solid fa-reply"></i> Reply</a>
                                            <a onclick="ThreadManager.load().messageReactions('${data.id}'); return false;" class="dropdown-item" href="#"><i class="fas fa-grin-tongue"></i> View Reactions</a>
                                            <a onclick="ThreadManager.archive().Message({id : '${data.id}'}); return false;" class="dropdown-item" href="#"><i class="fa-regular fa-trash-can"></i> Delete</a>
                                    </div>
                                </li>
                            </ul>
                        </div>`
            }
        },
        pending_message : function(data){
            return '<div id="pending_message_'+data.id+'" class="message my-message"><div class="message-body"><div class="message-body-inner"><div class="message-info">' +
                '<h5> <i class="far fa-clock"></i>a few seconds ago</h5></div><hr><div class="message-text">' +
                templates.message_body(data, true) +
                '</div></div></div>' +
                '<div id="pending_message_loading_'+data.id+'" class="float-right pt-2 h6 text-primary NS"><span title="Sending..." class="spinner-grow spinner-grow-sm"></span></div>' +
                '<div class="clearfix"></div></div>'
        },
        pending_message_grouped : function(data){
            return '<div id="pending_message_'+data.id+'" class="message grouped-message my-message"><div class="message-body"><div class="message-body-inner">' +
                '<div class="message-text pt-2">' +
                templates.message_body(data, true) +
                '</div></div></div>' +
                '<div id="pending_message_loading_'+data.id+'" class="float-right pt-1 h6 text-primary NS"><span title="Sending..." class="spinner-grow spinner-grow-sm"></span></div>' +
                '<div class="clearfix"></div></div>'
        },
        images_message : function(data){
            return '<div class="messages-image-view col text-center">' +
                '<a target="_blank" href="'+data.image.lg+'">' +
                '<img class="lazy img-fluid shadow rounded" data-src="'+data.image.md+'" /><br><br>' +
                Messenger.format().escapeHtml(data.owner.name)+' on '+Messenger.format().makeHumanTime(data.created_at)+
                '</a></div><hr>'
        },
        message_reactions : function(message, mine, grouped){
            if(message.reacted){
                let html = '<div class="clearfix"></div><div class="message-reactions '+(grouped ? "" : "grouped-reactions")+' '+(mine ? "my-reactions" : "")+'"><div class="reactions-body px-1">';
                for(const reaction in message.reactions.data){
                    if(message.reactions.data.hasOwnProperty(reaction)){
                        let reactedByMe = message.reactions.data[reaction].find(function(reactors){
                            return Messenger.isProvider(reactors.owner_id, reactors.owner_type);
                        });
                        let names = '';
                        let reactionCount = message.reactions.data[reaction].length;
                        for(let y = 0; y < reactionCount; y++) {
                            if(y === 0){
                                names += message.reactions.data[reaction][y].owner.name;
                            }
                            else if(y === 1 && reactionCount === 2){
                                names += ' and '+message.reactions.data[reaction][y].owner.name;
                            }
                            else if(y === 2){
                                if(reactionCount === 3){
                                    names += ' and '+message.reactions.data[reaction][y].owner.name;
                                } else {
                                    names += ', '+message.reactions.data[reaction][y].owner.name+' and '+(reactionCount-3)+' others';
                                }
                                break;
                            } else {
                                names += ', '+message.reactions.data[reaction][y].owner.name;
                            }
                        }
                        names += ' reacted with '+reaction;
                        let tooltip = Messenger.format().escapeHtml('<div class="row my-2 mr-2"><div class="col-3">'+Messenger.format().shortcodeToImage(reaction)+'</div><div class="col-9">'+names+'</div></div>');
                        if(reactedByMe){
                            html += '<span data-bs-toggle="tooltip" data-html="true" title="'+tooltip+'" data-bs-placement="top" onclick="ThreadManager.removeReaction({message_id : \''+message.id+'\', id : \''+reactedByMe.id+'\'})" ' +
                                ' class="reaction-badge reacted-by-me badge badge-light px-1 pointer_area">'+methods.format_message_body(reaction, true)+
                                '<span class="ml-1 fw-bold text-primary">'+message.reactions.data[reaction].length+'</span></span>';
                        } else {
                            html += '<span data-bs-toggle="tooltip" data-html="true" title="'+tooltip+'" data-bs-placement="top" onclick="ThreadManager.addNewReaction({message_id : \''+message.id+'\', emoji : \''+reaction+'\'})"' +
                                ' class="reaction-badge badge badge-light px-1 pointer_area">'+methods.format_message_body(reaction, true)+
                                '<span class="ml-1 fw-bold text-dark">'+message.reactions.data[reaction].length+'</span></span>';
                        }
                    }
                }
                return html+'</div></div>';
            }
            return '';
        },
        show_message_reactions : function(data){
            if(data.meta.total === 0){
                return '<div class="text-center h3"><i class="fas fa-frown"></i> No reactions</div>';
            }
            let html = '';
            for(const reaction in data.data){
                if(data.data.hasOwnProperty(reaction)){
                    html += '<div class="row mr-1"><div class="col-4 text-center p-0 my-1">'+methods.format_message_body(reaction, true)+'</div><div class="col-8 p-0"><ul class="list-unstyled mb-1">';
                    data.data[reaction].forEach(function (reactor) {
                        html += '<li class="thread_list_item" id="react_li_item_'+reactor.id+'"><div class="d-inline"><img height="20" width="20" class="rounded-circle" src="'+reactor.owner.avatar.sm+'"/> '+reactor.owner.name+'</div>'+
                            ((ThreadManager.state().thread_admin || Messenger.isProvider(reactor.owner_id, reactor.owner_type))
                                ? '<div onclick="ThreadManager.removeReaction({message_id : \''+reactor.message_id+'\', id : \''+reactor.id+'\'}, true)" class="float-right h6 pointer_area mt-0 mr-1 text-danger"><i title="Remove" class="fas fa-times"></i></div>'
                                : '')+
                            '</li><div class="clearfix"></div>'
                    });
                    html += '</ul></div></div><hr class="my-2">';
                }
            }
            return html;
        },
        my_message: function (data){
            return `
            <div class="chat chat-right my-message" id="message_${data.id}">
                <div class="chat-body message-body">
                    <div class="chat-bubble">
                        <div class="chat-content">
                            ${templates.message_body(data, false)}
                            <span class="chat-time"><time title="${Messenger.format().makeHumanTime(data.created_at)}" class="timeago" datetime="${data.created_at}">${Messenger.format().makeTimeAgo(data.created_at)}</time></span>
                        </div>
                        ${templates.my_message_options(data, false)}
                        <div class="reactions">${templates.message_reactions(data, true, false)}</div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            `
        },
        my_message_grouped: function(data){
            return `
            <div class="chat chat-right grouped-message my-message" id="message_${data.id}">
                <div class="chat-body message-body">
                    <div class="chat-bubble">
                        <div class="chat-content">
                            <div title="${Messenger.format().escapeHtml(data.owner.name)} on ${Messenger.format().makeHumanTime(data.created_at)}" class="message-text pt-2">
                            ${templates.message_body(data, false)}
                            </div>
                        </div>
                        ${templates.my_message_options(data, true)}
                        <div class="reactions">${templates.message_reactions(data, true, true)}</div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            `
        },
        my_message_reply : function(data){
            return `
            <div class="chat chat-right my-message" id="message_${data.id}">
                <div class="chat-body message-body">
                    <div class="chat-bubble">
                        <div class="chat-content">
                            ${templates.message_reply_item(data)}
                            ${templates.message_body(data, false)}
                            <span class="chat-time"><time title="${Messenger.format().makeHumanTime(data.created_at)}" class="timeago" datetime="${data.created_at}">${Messenger.format().makeTimeAgo(data.created_at)}</time></span>
                        </div>
                        ${templates.my_message_options(data, false)}
                        <div class="reactions">${templates.message_reactions(data, true, false)}</div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>`
        },
        message : function(data){
            return `<div class="chat chat-left" id="message_${data.id}">
                    <div class="chat-avatar">
                        <a ${(data.owner.route ? '' : 'onclick="return false;" href="'+(data.owner.route ? data.owner.route : '#')+'" target="_blank"')} class="avatar">
                            <img title="${Messenger.format().escapeHtml(data.owner.name)}" src="${data.owner.avatar.sm}" alt="User Image">
                        </a>
                    </div>
                    <div class="chat-body message-body">
                        <div class="chat-bubble">
                            <div class="chat-content">
                                ${templates.message_body(data, false)}
                                <span>${data.owner.name+(data.from_bot ? '<span class="ml-1 badge badge-warning">BOT</span>' : '')}</span>
                                <span class="chat-time"><time title="${Messenger.format().makeHumanTime(data.created_at)}" class="timeago" datetime="${data.created_at}">${Messenger.format().makeTimeAgo(data.created_at)}</time></span>
                            </div>
                            ${templates.my_message_options(data, false)}
                            <div class="reactions">${templates.message_reactions(data, false, false)}</div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>`
        },     
        message_grouped: function(data){
            return `<div class="chat chat-left" id="message_${data.id}">
            <div class="chat-avatar">
                <a ${(data.owner.route ? '' : 'onclick="return false;" href="'+(data.owner.route ? data.owner.route : '#')+'" target="_blank"')} class="avatar">
                    <img title="${Messenger.format().escapeHtml(data.owner.name)}" src="${data.owner.avatar.sm}" alt="User Image">
                </a>
            </div>
            <div class="chat-body message-body">
                <div class="chat-bubble">
                    <div class="chat-content">
                        ${templates.message_body(data, false)}
                        <span class="chat-time"><time title="${Messenger.format().escapeHtml(data.owner.name) +' on '+ Messenger.format().makeHumanTime(data.created_at)}" class="timeago" datetime="${data.created_at}">${Messenger.format().makeTimeAgo(data.created_at)}</time></span>
                    </div>
                    ${templates.my_message_options(data, true)}
                    <div class="reactions">${templates.message_reactions(data, false, true)}</div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>`
        },   
        message_reply : function(data){
            return `<div class="chat chat-left" id="message_${data.id}">
                    <div class="chat-avatar">
                        <a ${(data.owner.route ? '' : 'onclick="return false;" href="'+(data.owner.route ? data.owner.route : '#')+'" target="_blank"')} class="avatar">
                            <img title="${Messenger.format().escapeHtml(data.owner.name)}" src="${data.owner.avatar.sm}" alt="User Image">
                        </a>
                    </div>
                    <div class="chat-body message-body">
                        <div class="chat-bubble">
                            <div class="chat-content ${templates.message_reply_highlight(data)}">
                                ${templates.message_reply_item(data)}
                                ${templates.message_body(data, false)}
                                <span>${data.owner.name+(data.from_bot ? '<span class="ml-1 badge badge-warning">BOT</span>' : '')}</span>
                                <span class="chat-time"><time title="${Messenger.format().makeHumanTime(data.created_at)}" class="timeago" datetime="${data.created_at}">${Messenger.format().makeTimeAgo(data.created_at)}</time></span>
                            </div>
                            ${templates.my_message_options(data, false)}
                            <div class="reactions">${templates.message_reactions(data, false, false)}</div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>`
        },
        message_reply_item : function(data){
            let msg = '<footer class="text-secondary my-1">Replying to unknown</footer>';
            if(data.hasOwnProperty('reply_to') && data.reply_to !== null){
                msg = `<p class="mb-3">${templates.message_body(data.reply_to, false, true)}</p><footer class="text-secondary">Replying to ${data.reply_to.owner.name}</footer>`;
            }
            return `<blockquote class="border-left reply-border my-1 ms-1">${msg}</blockquote><hr>`;
        },
        message_reply_highlight : function(data){
            return data.hasOwnProperty('reply_to')
                && data.reply_to !== null
                && Messenger.isProvider(data.reply_to.owner_id, data.reply_to.owner_type)
                ? 'message-reply-highlight'
                : '';
        },
        loading_history : function(){
            return `<div id="loading_history_marker" class="system-message pt-0 mt-n4 w-100 text-center">
            <span class="text-primary spinner-grow spinner-grow-sm"></span></div>`
        },
        end_of_history : function(created_at){
            return `
            <div title="Conversation started on '${Messenger.format().makeHumanTime(created_at)}'"
                id="end_history_marker" class="alert-primary shadow-sm rounded mb-4 mt-n3 w-100 text-center text-dark">
                <strong><i class="fas fa-comments"></i> Start of conversation
            </div>
            `
        },
        system_message : function (data, modal) {
            let icon = 'fas fa-info-circle', extra = '';
            switch(data.type){
                case 88:
                    icon = 'fas fa-link';
                break;
                case 90:
                    icon = 'fas fa-video';
                break;
                case 91:
                    icon = 'far fa-image';
                break;
                case 92:
                    icon = 'fas fa-trash';
                break;
                case 93:
                    icon = 'fas fa-folder-plus';
                break;
                case 94:
                    icon = 'fas fa-edit';
                break;
                case 95:
                    icon = 'fas fa-user-slash';
                break;
                case 96:
                    icon = 'fas fa-chess-king';
                break;
                case 97:
                    icon = 'fas fa-sign-out-alt';
                break;
                case 98:
                    icon = 'far fa-minus-square';
                break;
                case 99:
                    icon = 'far fa-plus-square';
                break;
                case 100:
                case 101:
                case 102:
                case 103:
                case 104:
                    icon = 'fas fa-robot';
                break;
            }
            return '<div id="'+(modal === true ? 'modal_' : '')+'message_'+data.id+'" class="system-message alert-warning rounded py-1 w-100 text-center" ' +
                    'title="'+Messenger.format().escapeHtml(data.owner.name)+' on '+Messenger.format().makeHumanTime(data.created_at)+'"><i class="'+icon+'"></i> ' +
                    '<strong>'+data.owner.name+'</strong> '+data.body+extra+'</div>';
        },
        thread_call_state : function(data){
            if(CallManager.state().call_type === 2 || data.locked) return '';
            if(data.has_call){
                if(data.resources.active_call.options.in_call){
                    return '<button onclick="CallManager.join({id : \''+data.resources.active_call.id+'\', thread_id : \''+data.id+'\', type : 1})"' +
                        ' data-bs-toggle="tooltip" title="You are in this call" data-bs-placement="left" class="btn btn-lg btn-outline-danger video_btn pt-1 pb-0 px-2" type="button"><i class="fas fa-video fa-2x"></i></button>'
                }
                return '<button onclick="CallManager.join({id : \''+data.resources.active_call.id+'\', thread_id : \''+data.id+'\', type : 1})" ' +
                    'data-bs-toggle="tooltip" title="Join call" data-bs-placement="left" class="glowing_btn btn btn-lg btn-success video_btn pt-1 pb-0 px-2" type="button"><i class="fas fa-video fa-2x"></i></button>'
            }
            if(data.type === 1){
                return '<button onclick="ThreadManager.calls().initCall()" data-bs-toggle="tooltip" title="Call '+Messenger.format().escapeHtml(data.name)+'" data-bs-placement="left" ' +
                    'class="btn btn-lg text-secondary btn-light pt-1 pb-0 px-2 video_btn" type="button"><i class="fas fa-video fa-2x"></i></button>';
            }
            if(data.options.call){
                return '<button onclick="ThreadManager.calls().initCall()" data-bs-toggle="tooltip" title="Start a group call" data-bs-placement="left" ' +
                        'class="btn btn-lg text-secondary btn-light pt-1 pb-0 px-2 video_btn" type="button"><i class="fas fa-video fa-2x"></i></button>';
            }
            return ''
        },
        thread_group_headerNew: function(data){
            let knock = `<button onclick="${ThreadManager.calls().sendKnock()}" id="knok_btn" data-bs-toggle="tooltip" title="Knock at ${Messenger.format().escapeHtml(data.name)}" data-bs-placement="bottom" class="btn btn-lg text-secondary btn-light pt-1 pb-0 px-2" type="button"><i class="fas fa-hand-rock fa-2x"></i></button>`,
            invites = `<a class="dropdown-item" onclick="ThreadManager.group().viewInviteGenerator(); return false;" id="threadOptionLink" href="#"><i class="fas fa-link"></i> Invitations</a>`,
            admin = `<a class="dropdown-item" onclick="ThreadManager.group().viewSettings(); return false;" id="threadOptionLink" href="#"><i class="fas fa-cog"></i> Settings</a>`,
            view_participants = `<a class="dropdown-item" onclick="ThreadManager.group().viewParticipants(); return false;" id="viewParticipantLink" href="#"><i class="fas fa-users"></i> Participants</a>`,
            view_bots = `<a class="dropdown-item" onclick="ThreadBots.viewBots(); return false;" id="viewBotsLink" href="#"><i class="fas fa-robot"></i> Chat Bots</a>`;
            return `<div class="fixed-header">
                        <div class="navbar">
                            <ul class="nav custom-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="#">${templates.thread_socket_error(true)}</a>
                                </li>
                                <li class="nav-item">
                                    <span id="thread_option_call" class="nav-link">${templates.thread_call_state(data)}</span>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link"><i class="fa-solid fa-hand-rock"></i></a>
                                </li>
                                <li class="nav-item dropdown dropdown-action">
                                    <a aria-expanded="false" data-bs-toggle="dropdown" class="nav-link dropdown-toggle"
                                        href=""><i class="fa-solid fa-gear"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="javascript:void(0)" class="dropdown-item">Delete Conversations</a>
                                        <a href="javascript:void(0)" class="dropdown-item">Settings</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>`;
        },
        thread_group_header : function(data){
            let knok = '<button onclick="ThreadManager.calls().sendKnock()" id="knok_btn" data-bs-toggle="tooltip" title="Knock at '+Messenger.format().escapeHtml(data.name)+'" ' +
                'data-bs-placement="bottom" class="btn btn-lg text-secondary btn-light pt-1 pb-0 px-2" type="button"><i class="fas fa-hand-rock fa-2x"></i></button>',
            invites = '<a class="dropdown-item" onclick="ThreadManager.group().viewInviteGenerator(); return false;" id="threadOptionLink" href="#"><i class="fas fa-link"></i> Invitations</a>\n',
            admin = '<a class="dropdown-item" onclick="ThreadManager.group().viewSettings(); return false;" id="threadOptionLink" href="#"><i class="fas fa-cog"></i> Settings</a>\n',
            view_participants = '<a class="dropdown-item" onclick="ThreadManager.group().viewParticipants(); return false;" id="viewParticipantLink" href="#"><i class="fas fa-users"></i> Participants</a>\n',
            view_bots = '<a class="dropdown-item" onclick="ThreadBots.viewBots(); return false;" id="viewBotsLink" href="#"><i class="fas fa-robot"></i> Chat Bots</a>\n';

            return '<div id="thread_header_area"><div class="dropdown float-right">\n' +
                    templates.thread_socket_error(true)+
                    '<span id="thread_option_call">'+templates.thread_call_state(data)+'</span>\n' +
                    (!data.locked && data.options.knock ? knok : '')+
                    '    <button class="btn btn-lg text-secondary btn-light dropdown-toggle pt-1 pb-0 px-2" type="button" data-toggle="dropdown"><i class="fas fa-cog fa-2x"></i></button>\n' +
                    '    <div class="dropdown-menu dropdown-menu-right">\n' +
                    '        <div class="dropdown-header py-0 h6 text-dark"><img id="group_avatar_'+data.id+'" alt="Group Image" class="show_group_avatar_'+data.id+' rounded-circle small_img" src="'+data.avatar.sm+'"/>' +
                    '           <span id="group_name_area">'+data.name+'</span></div>\n' +
                        templates.thread_resource_dropdown() +
                    view_participants +
                    (!data.locked && data.options.chat_bots ? view_bots : '')+
                    (!data.locked && data.options.invitations ? invites : '')+
                    (!data.locked && data.options.admin ? admin : '')+
                    '<div class="dropdown-divider"></div>' +
                (data.locked
                        ? ''
                        : (data.options.muted ? '<a onclick="ThreadManager.mute().unmute(); return false;" class="dropdown-item" href="#"><i class="fas fa-volume-up"></i> Unmute</a>'
                            : '<a onclick="ThreadManager.mute().mute(); return false;" class="dropdown-item" href="#"><i class="fas fa-volume-mute"></i> Mute</a>')
                ) +
                '<a class="dropdown-item" onclick="ThreadManager.group().leaveGroup(); return false;" id="leaveGroupLink" href="#"><i class="fas fa-sign-out-alt"></i> Leave Group</a>'+
                    '</div>'+
                '<button onclick="ThreadManager.load().closeOpened()" title="Close" class="btn btn-lg text-danger btn-light pt-1 pb-0 px-2 mr-1" type="button"><i class="fas fa-times fa-2x"></i></button>'+
                '</div>'+
                '<img onclick="ThreadTemplates.render().show_thread_avatar(\''+data.avatar.lg+'\')" data-bs-toggle="tooltip" data-bs-placement="right" title="'+Messenger.format().escapeHtml(data.name)+'" class="ml-1 rounded-circle medium-image main-bobble-online pointer_area" src="'+data.avatar.sm+'" />'+
                '<div id="thread_error_area"></div></div>'
        },
        thread_resource_dropdown : function(){
            return `
                <hr>
                <a onclick="ThreadManager.load().threadDocuments(); return false;" class="dropdown-item" href="#"><i class="fas fa-file-alt"></i> Documents</a>
                <a onclick="ThreadManager.load().threadImages(); return false;" class="dropdown-item" href="#"><i class="fas fa-images"></i> Images</a>
                <a onclick="ThreadManager.load().threadAudio(); return false;" class="dropdown-item" href="#"><i class="fas fa-music"></i> Audio</a>
                <a onclick="ThreadManager.load().threadVideos(); return false;" class="dropdown-item" href="#"><i class="fas fa-video"></i> Videos</a>
                <a onclick="ThreadManager.load().threadLogs(); return false;" class="dropdown-item" href="#"><i class="fas fa-database"></i> Logs</a>
                <hr>
            `;
        },
        thread_network_opt : function(data){
            if(!Messenger.isProvider(data.provider_id, null, data.provider_alias)
                && data.options.friendable
                && (data.options.can_friend || data.options.friend_status !== 0))
            {
                switch(data.options.friend_status){
                    case 0: return '<a class="dropdown-item network_option" onclick="FriendsManager.action({dropdown : true, provider_id : \''+data.provider_id+'\', action : \'add\', provider_alias : \''+data.provider_alias+'\'}); return false;" href="#"><i class="fas fa-user-plus"></i> Add friend</a>';
                    case 1: return '<a class="dropdown-item network_option" onclick="FriendsManager.action({dropdown : true, provider_id : \''+data.provider_id+'\', action : \'remove\', friend_id : \''+data.options.friend_id+'\', provider_alias : \''+data.provider_alias+'\'}); return false;" href="#"><i class="fas fa-user-times"></i> Remove friend</a>';
                    case 2: return '<a class="dropdown-item network_option" onclick="FriendsManager.action({dropdown : true, provider_id : \''+data.provider_id+'\', action : \'cancel\', sent_friend_id : \''+data.options.sent_friend_id+'\', provider_alias : \''+data.provider_alias+'\'}); return false;" href="#"><i class="fas fa-ban"></i> Cancel friend request</a>';
                    case 3: return '<a class="dropdown-item network_option" onclick="FriendsManager.action({dropdown : true, provider_id : \''+data.provider_id+'\', action : \'accept\', pending_friend_id : \''+data.options.pending_friend_id+'\', provider_alias : \''+data.provider_alias+'\'}); return false;" href="#"><i class="far fa-check-circle"></i> Accept friend request</a>' +
                        '<a class="dropdown-item network_option" onclick="FriendsManager.action({dropdown : true, provider_id : \''+data.provider_id+'\', action : \'deny\', pending_friend_id : \''+data.options.pending_friend_id+'\', provider_alias : \''+data.provider_alias+'\'}); return false;" href="#"><i class="fas fa-ban"></i> Deny friend request</a>';
                }
            }
            return ''
        },
        private_pending_state : function(data){
            if(data.pending){
                if(data.options.awaiting_my_approval){
                    return '<button id="thread_approval_accept_btn" onclick="ThreadManager.newForms().threadApproval(true)" data-bs-toggle="tooltip" title="Accept Message Request" data-bs-placement="left" ' +
                        'class="btn btn-lg btn-success pt-1 pb-0 px-2 '+(!Messenger.common().mobile ? 'mr-1' : '')+'" type="button"><i class="fas fa-check-circle fa-2x"></i></button>'+
                        '<button id="thread_approval_deny_btn" onclick="ThreadManager.newForms().threadApproval(false)" data-bs-toggle="tooltip" title="Deny Message Request" data-bs-placement="bottom" ' +
                        'class="btn btn-lg btn-danger pt-1 pb-0 px-2" type="button"><i class="fas fa-times-circle"></i></button>'
                }
                return '<button data-bs-toggle="tooltip" title="Waiting for approval" data-bs-placement="left" ' +
                    'class="btn btn-lg btn-info pt-1 pb-0 px-2 '+(!Messenger.common().mobile ? 'mr-1' : '')+'" type="button"><i class="fas fa-hourglass"></i></button>'
            }
            return '';
        },
        thread_private_header: function(data){
            let base = `<div class="dropdown-divider"></div>
                ${(data.locked ? '' : (data.options.muted ? '<a onclick="ThreadManager.mute().unmute(); return false;" class="dropdown-item" href="#"><i class="fas fa-volume-up"></i> Unmute</a>' : '<a onclick="ThreadManager.mute().mute(); return false;" class="dropdown-item" href="#"><i class="fas fa-volume-mute"></i> Mute</a>')
                )}<a onclick="ThreadManager.archive().Thread(); return false;" class="dropdown-item" href="#"><i class="fas fa-trash"></i> Delete Conversation</a>
                </div>`;

                return `<div class="fixed-header">
                            <div class="navbar">
                                <div id="main_bobble_${data.resources.recipient.provider_id}">
                                    ${templates.thread_private_header_bobble(data.resources.recipient)}
                                </div>
                                <ul class="nav custom-menu">
                                    <li class="nav-item">
                                        ${templates.thread_socket_error(true)}
                                    </li>
                                    <li class="nav-item">
                                        ${templates.private_pending_state(data)}
                                    </li>
                                    <li class="nav-item">
                                        <span id="thread_option_call">${(!data.options.call && !data.has_call ? '' : templates.thread_call_state(data))}</span>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link" onclick="ThreadManager.calls().sendKnock()" id="knok_btn" data-bs-toggle="tooltip" data-bs-title="Knock at ${Messenger.format().escapeHtml(data.name)}" data-bs-placement="bottom">
                                            <i class="fa-solid fa-hand-rock"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link mr-1" onclick="ThreadManager.load().closeOpened()" data-bs-toggle="tooltip" data-bs-title="Close" data-bs-placement="bottom">
                                            <i class="fa-solid fa-times"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item dropdown dropdown-action">
                                        <a aria-expanded="false" data-bs-toggle="dropdown" class="nav-link dropdown-toggle"
                                            href=""><i class="fa-solid fa-gear"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                        <div ${(data.resources.recipient.route) ? 'onclick=window.open("'+data.resources.recipient.route+'")' : ''} class="pointer_area dropdown-header py-0">
                                            <img alt="Profile Image" class="rounded-circle small_img" src="${data.resources.recipient.avatar.sm}"/>${data.name}</div>                                        
                                            ${templates.thread_resource_dropdown()}
                                            <div id="network_for_${data.resources.recipient.provider_id}" class="profile_network_options">${templates.thread_network_opt(data.resources.recipient)}</div>
                                            ${(data.pending && data.options.awaiting_my_approval
                                                ? '</div>'
                                                : base )}
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>`;
        },
        thread_private_headerOld : function(data){
            let base = '<div class="dropdown-divider"></div>' +
                (data.locked
                        ? ''
                        : (data.options.muted ? '<a onclick="ThreadManager.mute().unmute(); return false;" class="dropdown-item" href="#"><i class="fas fa-volume-up"></i> Unmute</a>'
                            : '<a onclick="ThreadManager.mute().mute(); return false;" class="dropdown-item" href="#"><i class="fas fa-volume-mute"></i> Mute</a>')
                ) +
                '<a onclick="ThreadManager.archive().Thread(); return false;" class="dropdown-item" href="#"><i class="fas fa-trash"></i> Delete Conversation</a>' +
                '</div>';

            return '<div id="thread_header_area"><div class="dropdown float-right">\n' +
                templates.thread_socket_error()+
                templates.private_pending_state(data)+
                '    <span id="thread_option_call">'+(!data.options.call && !data.has_call ? '' : templates.thread_call_state(data))+'</span>\n' +
                (!data.locked && data.options.knock ?
                    '<button onclick="ThreadManager.calls().sendKnock()" id="knok_btn" data-bs-toggle="tooltip" title="Knock at '+Messenger.format().escapeHtml(data.name)+'" data-bs-placement="bottom" class="btn btn-lg text-secondary btn-light pt-1 pb-0 px-2 mr-1" type="button"><i class="fas fa-hand-rock fa-2x"></i></button>'
                    : '')+
                '<button class="btn btn-lg text-secondary btn-light dropdown-toggle pt-1 pb-0 px-2" type="button" data-toggle="dropdown"><i class="fas fa-cog fa-2x"></i></button>\n' +
                '<div class="dropdown-menu dropdown-menu-right">\n' +
                '    <div '+(data.resources.recipient.route ? 'onclick="window.open(\''+data.resources.recipient.route+'\')"' : '')+' class="pointer_area dropdown-header py-0 h6 text-dark"><img alt="Profile Image" class="rounded-circle small_img" src="'+data.resources.recipient.avatar.sm+'"/> '+data.name+'</div>\n' +
                templates.thread_resource_dropdown() +
                '    <div id="network_for_'+data.resources.recipient.provider_id+'" class="profile_network_options">'+templates.thread_network_opt(data.resources.recipient)+'</div>'+
                (data.pending && data.options.awaiting_my_approval
                    ? '</div>'
                    : base ) +
                '<button onclick="ThreadManager.load().closeOpened()" title="Close" class="btn btn-lg text-danger btn-light pt-1 pb-0 px-2 mr-1" type="button"><i class="fas fa-times fa-2x"></i></button>'+
                '</div><div id="main_bobble_'+data.resources.recipient.provider_id+'">'+templates.thread_private_header_bobble(data.resources.recipient)+'</div></div>'
        },
        thread_new_header : function(party){
            return '<div id="thread_header_area"><div class="dropdown float-right">\n' +
                '<button class="btn btn-lg text-secondary btn-light dropdown-toggle pt-1 pb-0 px-2" type="button" data-toggle="dropdown"><i class="fas fa-cog fa-2x"></i></button>\n' +
                '<div class="dropdown-menu dropdown-menu-right">\n' +
                '    <div '+(party.route ? 'onclick="window.open(\''+party.route+'\')"' : '')+' class="pointer_area dropdown-header py-0 h6 text-dark"><img alt="Profile Image" class="rounded-circle small_img" src="'+party.avatar.sm+'"/> '+party.name+'</div>\n' +
                '    <div class="dropdown-divider"></div>\n' +
                '    <div id="network_for_'+party.provider_id+'" class="profile_network_options">'+templates.thread_network_opt(party)+'</div>'+
                '</div>'+
                '<button onclick="ThreadManager.load().closeOpened()" title="Close" class="btn btn-lg text-danger btn-light pt-1 pb-0 px-2 mr-1" type="button"><i class="fas fa-times fa-2x"></i></button>'+
                '</div><div id="main_bobble_'+party.provider_id+'">'+templates.thread_private_header_bobble(party)+'</div>'+
                '</div>'
        },
        thread_new_fill : function(data){
            if(data.options.can_message_first){
                return '<div class="col-12 text-center text-info fw-bold h4 mt-5">\n' +
                    '<i class="fas fa-comments"></i> Starting a new conversation with<br/> '+data.name+
                    '</div>'
            }
            return '<div class="col-12 text-center text-danger fw-bold h4 mt-5">\n' +
                '<i class="fas fa-comment-slash"></i> Cannot start a conversation with<br/> '+data.name+
                '</div>'
        },
        thread_empty_search : function(more, none){
            let msg = 'Search above for other profiles on '+Messenger.common().APP_NAME+'!';
            if(more) msg = none ? 'No matching profiles were found' : 'Use at least 3 characters in your query';
            return '<div class="col-12 text-center text-info fw-bold h4 mt-5">\n' +
                '<i class="fas fa-search"></i> '+msg+
                '</div>'
        },
        thread_private_header_bobble : function(data, demo){
            let nameTitle = Messenger.format().escapeHtml(data.name);
            if(demo){
                return `
                <div class="user-details me-auto">
                    <div class="float-start user-img">
                        <a class="avatar" href="#" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Demo Chat">
                            <img src="/images/user.jpg" alt="User Image" class="rounded-circle">
                        </a>
                    </div>
                    <div class="user-info float-start">
                        <span>Demo User </span>
                    </div>
                </div>
                `;
            }
            let status;
            switch(data.options.online_status){
                case 0:
                    if(data.options.last_active){
                        status = 'last seen '+ Messenger.format().makeTimeAgo(data.options.last_active);
                    }
                    else{
                        status = 'is offline';
                    }
                break;
                case 1: status = 'is online'; break;
                case 2: status = 'is away'; break;
            }
            return `<div class="user-details me-auto">
                        <div class="float-start user-img">
                            <a class="avatar" href="#" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="${nameTitle} ${status}">
                                <img src="${data.avatar.sm ?? '/images/user.jpg'}" onclick="${ThreadTemplates.render().show_thread_avatar(data.avatar.lg)}" alt="User Image"
                                    class="rounded-circle">
                            </a>
                            <span class="status ${(data.options.online_status === 1 ? 'online' : (data.options.online_status === 2 ? 'away' : 'offline'))}"></span>
                        </div>
                        <div class="user-info float-start">
                            <a href="#" title="${nameTitle} ${status}">
                                <span>${nameTitle}</span> 
                            </a>
                            <span class="userTyping"><i class="typing-text">Typing...</i></span>
                            <span class="last-seen"${status}</span>
                        </div>
                    </div>`
        },
        my_avatar_status : function(state){
            let online;
            switch(state){
                case 0: online = 'offline'; break;
                case 1: online = 'online'; break;
                case 2: online = 'away'; break;
            }
            return '<img data-bs-toggle="tooltip" data-bs-placement="right" title="You are '+online+'" class="my-global-avatar ml-1 rounded-circle medium-image avatar-is-'+online+'" src="'+Messenger.common().slug+'" />'
        },
        show_thread_avatar : function(avatar){
            Messenger.alert().showAvatar(ThreadManager.state().t_name, avatar);
        },
        thread_new_message_alert : function(){
            return '<div class="text-center h6 fw-bold"><div class="py-2 alert alert-warning border-info shadow" role="alert">You have new messages <i class="fas fa-level-down-alt"></i></div></div>'
        },
        thread_replying_message_alert : function(message){
            return '<div class="text-center h6 fw-bold">' +
                '<div class="py-2 alert alert-primary border-secondary shadow" role="alert">' +
                '<i class="fas fa-reply"></i> <img height="25" width="25" class="rounded-circle" src="'+message.owner.avatar.sm+'"> Replying to '+message.owner.name+' <span class="float-right"><i class="fas fa-times-circle"></i></span><hr class="my-2">' +
                '<div class="col-12 replying-to-alert">'+templates.message_body(message, false, true, true)+'</div> ' +
                '</div>' +
                '</div>'
        },
        group_settings : function(settings){
            return '<form id="group_settings_form" action="javascript:ThreadManager.group().saveSettings()">\n' +
                '<div class="form-row mx-n2 rounded bg-light text-dark py-3 px-2 shadow-sm">\n' +
                '    <div class="input-group input-group-lg col-12 mb-0">\n' +
                '        <div class="input-group-prepend">\n' +
                '            <div class="input-group-text"><i class="fas fa-edit"></i></div>\n' +
                '         </div>\n' +
                '         <input autocomplete="off" maxlength="50" class="form-control fw-bold shadow-sm" id="g_s_group_subject" placeholder="Group Name" name="subject-'+Date.now()+'" required value="'+settings.name+'">' +
                '     </div>\n' +
                '</div>'+
                '    <hr>\n' +
                '    <div class="form-row mx-n2 rounded bg-light text-dark pb-3 pt-2 px-3 shadow-sm">\n' +
                '        <label class="fw-bold h5 control-label" for="g_s_table">Toggle Group Features:</label>\n' +
                '        <table id="g_s_table" class="table mb-0 table-sm table-hover">\n' +
                '            <tbody>\n' +
                '            <tr class="'+(settings.add_participants ? 'alert-success' : '')+'">\n' +
                '                <td class="pointer_area" onclick="$(\'#g_s_add_participants\').click()">\n' +
                '                    <div class="h4 mt-1"><i class="fas fa-caret-right"></i> <span class="h5">Add Participants</span></div>\n' +
                '                </td>\n' +
                '                <td>\n' +
                '                    <div class="mt-1 float-right"><span class="switch switch-sm mt-1">\n' +
                '                        <input class="switch switch_input m_setting_toggle" id="g_s_add_participants" name="g_s_add_participants" type="checkbox" '+(settings.add_participants ? 'checked' : '')+'>\n' +
                '                        <label for="g_s_add_participants"></label>\n' +
                '                    </span></div>\n' +
                '                </td>\n' +
                '            </tr>\n' +
                '            <tr class="'+(settings.invitations ? 'alert-success' : '')+'">\n' +
                '                <td class="pointer_area" onclick="$(\'#g_s_invitations\').click()">\n' +
                '                    <div class="h4 mt-1"><i class="fas fa-caret-right"></i> <span class="h5">Invitations</span></div>\n' +
                '                </td>\n' +
                '                <td>\n' +
                '                    <div class="mt-1 float-right"><span class="switch switch-sm mt-1">\n' +
                '                        <input class="switch switch_input m_setting_toggle" id="g_s_invitations" name="g_s_invitations" type="checkbox" '+(settings.invitations ? 'checked' : '')+'>\n' +
                '                        <label for="g_s_invitations"></label>\n' +
                '                    </span></div>\n' +
                '                </td>\n' +
                '            </tr>\n' +
                '            <tr class="'+(settings.calling ? 'alert-success' : '')+'">\n' +
                '                <td class="pointer_area" onclick="$(\'#g_s_admin_call\').click()">\n' +
                '                    <div class="h4 mt-1"><i class="fas fa-caret-right"></i> <span class="h5">Calling</span></div>\n' +
                '                </td>\n' +
                '                <td>\n' +
                '                    <div class="mt-1 float-right"><span class="switch switch-sm mt-1">\n' +
                '                        <input class="switch switch_input m_setting_toggle" id="g_s_admin_call" name="g_s_admin_call" type="checkbox" '+(settings.calling ? 'checked' : '')+'>\n' +
                '                        <label for="g_s_admin_call"></label>\n' +
                '                    </span></div>\n' +
                '                </td>\n' +
                '            </tr>\n' +
                '            <tr class="'+(settings.messaging ? 'alert-success' : '')+'">\n' +
                '                <td class="pointer_area" onclick="$(\'#g_s_send_message\').click()">\n' +
                '                    <div class="h4 mt-1"><i class="fas fa-caret-right"></i> <span class="h5">Messaging</span></div>\n' +
                '                </td>\n' +
                '                <td>\n' +
                '                    <div class="mt-1 float-right"><span class="switch switch-sm mt-1">\n' +
                '                        <input class="switch switch_input m_setting_toggle" id="g_s_send_message" name="g_s_send_message" type="checkbox" '+(settings.messaging ? 'checked' : '')+'>\n' +
                '                        <label for="g_s_send_message"></label>\n' +
                '                    </span></div>\n' +
                '                </td>\n' +
                '            </tr>\n' +
                '            <tr class="'+(settings.knocks ? 'alert-success' : '')+'">\n' +
                '                <td class="pointer_area" onclick="$(\'#g_s_knocks\').click()">\n' +
                '                    <div class="h4 mt-1"><i class="fas fa-caret-right"></i> <span class="h5">Knocks</span></div>\n' +
                '                </td>\n' +
                '                <td>\n' +
                '                    <div class="mt-1 float-right"><span class="switch switch-sm mt-1">\n' +
                '                        <input class="switch switch_input m_setting_toggle" id="g_s_knocks" name="g_s_knocks" type="checkbox" '+(settings.knocks ? 'checked' : '')+'>\n' +
                '                        <label for="g_s_knocks"></label>\n' +
                '                    </span></div>\n' +
                '                </td>\n' +
                '            </tr>\n' +
                '            <tr class="'+(settings.chat_bots ? 'alert-success' : '')+'">\n' +
                '                <td class="pointer_area" onclick="$(\'#g_s_bots\').click()">\n' +
                '                    <div class="h4 mt-1"><i class="fas fa-caret-right"></i> <span class="h5">Chat Bots</span></div>\n' +
                '                </td>\n' +
                '                <td>\n' +
                '                    <div class="mt-1 float-right"><span class="switch switch-sm mt-1">\n' +
                '                        <input class="switch switch_input m_setting_toggle" id="g_s_bots" name="g_s_bots" type="checkbox" '+(settings.chat_bots ? 'checked' : '')+'>\n' +
                '                        <label for="g_s_bots"></label>\n' +
                '                    </span></div>\n' +
                '                </td>\n' +
                '            </tr>\n' +
                '            </tbody>\n' +
                '        </table>\n' +
                '    </div>\n' +
                '    <hr>\n' +
                '    <div class="form-group mb-0 py-2 alert-dark shadow rounded">\n' +
                '    <div class="col-12">' +
                '        <img alt="Avatar" height="62" width="62" class="mr-3 rounded avatar-is-offline" src="'+settings.avatar.sm+'"/>' +
                '        <button onclick="$(\'#thread_avatar_image_file\').trigger(\'click\')" type="button" class="btn btn-sm btn-success mr-3"><i class="fas fa-image"></i> Upload Avatar</button>' +
                '        <button onclick="ThreadManager.group().removeGroupAvatar()" type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Remove Avatar</button>' +
                '    </div></div>\n' +
                '    </div>\n' +
                '    <hr>\n' +
                '    <div class="text-center form-group mb-0 py-2 alert-danger shadow rounded">\n' +
                '        <div class="mb-1 fw-bold">You will be asked to confirm this action</div>\n' +
                '        <button onclick="ThreadManager.archive().Thread()" type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Remove Group</button>\n' +
                '    </div>\n' +
                '</form>'
        },
        thread_generate_invite : function(back){
            return '<div id="grp_inv_make" class="row">\n' +
                '    <div class="col-12 mb-2">\n' +
                '        <div class="card">\n' +
                '            <div class="card-body bg-warning shadow-sm rounded">\n' +
                '                <h5>Generate a group invitation link that will allow those you share it with to join this group, given it meets the criteria you choose below</h5>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '    </div>\n' +
                '    <div class="col-12">\n' +
                '        <form id="grp_inv_form">\n' +
                '            <div class="form-row">\n' +
                '                <div class="form-group col-md-6">\n' +
                '                    <label for="grp_inv_expires">EXPIRE AFTER:</label>\n' +
                '                    <select class="form-control" id="grp_inv_expires" name="expires" required>\n' +
                '                        <option value="1">30 minutes</option>\n' +
                '                        <option value="2">1 hour</option>\n' +
                '                        <option value="3">6 hours</option>\n' +
                '                        <option value="4">12 hours</option>\n' +
                '                        <option value="5" selected>1 day</option>\n' +
                '                        <option value="6">1 week</option>\n' +
                '                        <option value="7">2 weeks</option>\n' +
                '                        <option value="8">1 month</option>\n' +
                '                        <option value="0">Never</option>\n' +
                '                    </select>\n' +
                '                </div>\n' +
                '                <div class="form-group col-md-6">\n' +
                '                    <label for="grp_inv_uses">MAX NUMBER OF USES:</label>\n' +
                '                    <select class="form-control" id="grp_inv_uses" name="uses" required>\n' +
                '                        <option value="0" selected>No limit</option>\n' +
                '                        <option value="1">1 use</option>\n' +
                '                        <option value="5">5 uses</option>\n' +
                '                        <option value="10">10 uses</option>\n' +
                '                        <option value="25">25 uses</option>\n' +
                '                        <option value="50">50 uses</option>\n' +
                '                        <option value="100">100 uses</option>\n' +
                '                    </select>\n' +
                '                </div>\n' +
                '            </div>\n' +
                '            <div class="col-12">\n' +
                '                <div class="text-center">\n' +
                '                    <button type="button" id="grp_inv_back_btn" class="btn btn-outline-dark '+(back ? "" : "NS")+'"><i class="fas fa-undo"></i> Cancel</button>\n' +
                '                    <button type="button" id="grp_inv_generate_btn" class="btn btn-success">Generate <i class="fas fa-random"></i></button>\n' +
                '                </div>\n' +
                '            </div>\n' +
                '        </form>\n' +
                '    </div>\n' +
                '</div>'
        },
        thread_invite : function(invite){
            return '<div class="card mb-3">\n' +
                '    <div class="card-body bg-secondary shadow rounded">\n' +
                '        <div class="col-12 mt-n2 mb-2 text-white">' +
                '            <span class="h6">Creator: '+invite.owner.name+'</span>' +
                '            <div class="float-right"><button onclick="ThreadManager.group().removeInviteLink(\''+invite.id+'\')" id="inv_remove_btn_'+invite.id+'" type="button" class="btn btn-sm btn-block btn-danger"><i class="fas fa-trash"></i></button></div>'+
                '   </div><hr>\n' +
                '        <div class="col-12 px-0">\n' +
                '           <form>\n' +
                '                <div class="input-group">\n' +
                '                  <input id="inv_generated_link_'+invite.id+'" class="form-control" value="'+invite.route+'" readonly>\n' +
                '                    <div class="input-group-append">\n' +
                '                    <button onclick="Messenger.format().copyText(\'grp_inv_copy_btn_'+invite.id+'\', \'inv_generated_link_'+invite.id+'\')" type="button" id="grp_inv_copy_btn_'+invite.id+'" class="btn btn-md btn-primary"><i class="far fa-copy"></i> Copy</button>\n' +
                '                     </div>\n' +
                '                        </div>\n' +
                '                    </form>\n' +
                '                </div>\n' +
                '                <div class="col-12 my-3">\n' +
                '                    <div class="row justify-content-center h5">\n' +
                '                        <span class="mb-2 mx-1 badge badge-pill badge-warning">Max Use: '+(invite.max_use > 0 ? invite.max_use : "No limit")+'</span>\n' +
                '                        <span class="mb-2 mx-1 badge badge-pill badge-warning">Current Use: '+invite.uses+'</span>\n' +
                '                        <span class="mb-2 mx-1 badge badge-pill badge-warning">Expires: '+(invite.expires_at ? Messenger.format().makeTimeAgo(invite.expires_at) : "Never")+'</span>\n' +
                '                    </div>\n' +
                '                </div>\n' +
                '            </div>\n' +
                '        </div>\n';
        },
        thread_show_invite : function(invites){
            let fill = '';
            invites.forEach((invite) => {
                fill += templates.thread_invite(invite)
            });
            return '<div id="grp_inv_show" class="row">\n' +
                '    <div class="col-12">\n' +
                '        <div class="col-12 mt-n2 mb-2 text-center"><span class="h5">Share invites with others to join to this group!</span></div><hr>\n' +
                fill +
                '    </div>\n' +
                '    <div class="col-12 text-center">\n' +
                '        <hr>\n' +
                '        <div class="col-12 mt-n3"><button type="button" id="grp_inv_switch_generate_btn" class="btn btn-success mt-3">Generate Invite <i class="fas fa-random"></i></button></div> \n' +
                '    </div>\n' +
                '</div>'
        },
        friends_fill : function(friend){
            return '<tr>\n' +
                '<td class="pointer_area" onclick="$(this).parent().children().find(\'.switch_input\').click()">\n' +
                '    <div class="nowrap">\n' +
                '        <img class="lazy rounded-circle group-image avatar-is-'+(friend.party.options.online_status === 1
                    ? "online" : friend.party.options.online_status === 2 ? "away" : "offline")+'" data-src="'+friend.party.avatar.sm+'"/>\n' +
                '        <span class="h5"><span class="badge badge-light">'+friend.party.name+'</span></span>\n' +
                '    </div>\n' +
                '</td>\n' +
                '<td>\n' +
                '    <div class="mt-1 float-right">\n' +
                '        <span class="switch switch-sm mt-1">\n' +
                '            <input data-provider-alias="'+friend.party.provider_alias+'" data-provider-id="'+friend.party_id+'" onchange="ThreadManager.switchToggle()" ' +
                '               class="switch switch_input" id="recipients_'+friend.party_id+'" name="recipients[]" value="'+friend.party_id+'" type="checkbox" />\n' +
                '            <label for="recipients_'+friend.party_id+'" class=""></label>\n' +
                '        </span>\n' +
                '    </div>\n' +
                '</td>\n' +
                '</tr>'
        },
        new_group_friends : function(friends){
            let top = '<div class="col-12">', bot = '</div>',
                none = '<h4 class="text-center my-5"><span class="badge badge-pill badge-secondary"><i class="fas fa-user-friends"></i> No friends to add</span></h4>',
                table_top = '<label class="fw-bold control-label h5 mb-3">Add friends to group:</label>' +
                    '<div class="row">\n' +
                    '    <div class="col-12">\n' +
                    '        <div class="table-responsive-sm">\n' +
                    '            <table id="add_group_participants" class="table table-sm table-hover">\n' +
                    '                <thead>\n' +
                    '                <tr>\n' +
                    '                    <th>Name</th>\n' +
                    '                    <th><span class="float-right">Add</span></th>\n' +
                    '                </tr>\n' +
                    '                </thead>\n' +
                    '                <tbody>',
                table_bot = '</tbody></table></div></div></div>',
                table_fill = '';
            if(!friends || !friends.length){
                return top+none+bot;
            }
            friends.forEach((friend) => {
                table_fill += templates.friends_fill(friend)
            });
            return top+table_top+table_fill+table_bot+bot
        },
        group_participant_permissions : function(participant){
            let permissions = '';
            if(participant.admin){
                permissions += '<span title="Admin" class="badge badge-danger"><i class="fas fa-chess-king"></i></span>';
            }
            else{
                if(participant.send_messages) permissions += '<span title="Send messages" class="badge badge-primary mr-1"><i class="fas fa-comment"></i></span>';
                if(participant.add_participants) permissions += '<span title="Add participants" class="badge badge-primary mr-1"><i class="fas fa-user-plus"></i></span>';
                if(participant.manage_invites) permissions += '<span title="Manage Invites" class="badge badge-primary mr-1"><i class="fas fa-link"></i></span>';
                if(participant.send_knocks) permissions += '<span title="Send knocks" class="badge badge-primary mr-1"><i class="fas fa-hand-rock"></i></span>';
                if(participant.start_calls) permissions += '<span title="Start Calls" class="badge badge-primary mr-1"><i class="fas fa-video"></i></span>';
                if(participant.manage_bots) permissions += '<span title="Manage Bots" class="badge badge-primary mr-1"><i class="fas fa-robot"></i></span>';
            }

            return permissions;
        },
        admin_participant_options : function(participant){
            let options = '<a class="dropdown-item" onclick="ThreadManager.group().removeParticipant(\''+participant.id+'\'); return false;" href="#" title="Remove"><i class="fas fa-trash-alt"></i> Remove</a>';
            if(participant.admin){
                options += '<a class="dropdown-item" onclick="ThreadManager.group().demoteAdmin(\''+participant.id+'\'); return false;" href="#" title="Revoke admin"><i class="fas fa-user-slash"></i> Demote admin</a>';
            }
            else{
                options += '<a class="dropdown-item" onclick="ThreadManager.group().promoteAdmin(\''+participant.id+'\'); return false;" href="#" title="Make admin"><i class="fas fa-chess-king"></i> Promote admin</a>';
                options += '<a class="dropdown-item" onclick="ThreadManager.group().participantPermissionsView(\''+participant.id+'\'); return false;" href="#" title="Make admin"><i class="fas fa-user-cog"></i> Permissions</a>';
            }
            return options;
        },
        group_participants : function(participants, admin, locked){
            let table_top = '<div class="row">\n' +
                '    <div class="col-12">\n' +
                '        <div class="table-responsive-sm">\n' +
                '            <table id="view_group_participants" class="table table-sm table-hover">\n' +
                '                <thead>\n' +
                '                <tr>\n' +
                '                    <th>Name</th>\n' +
                (admin ? '<th>Permissions</th>' : '') +
                '                    <th>Options</th>\n' +
                '                </tr>\n' +
                '                </thead>\n' +
                '                <tbody>',
                table_bot = '</tbody></table></div></div></div>',
                table_fill = '';
            let participant_fill = (participant) => {
                return '<tr id="row_'+participant.id+'">\n' +
                    '     <td class="pointer_area" onclick="ThreadManager.load().createPrivate({id : \''+participant.owner.provider_id+'\', alias : \''+participant.owner.provider_alias+'\'})">\n' +
                    '      <div class="participant_link table_links">\n' +
                    '        <div class="nowrap">\n' +
                    '          <img class="lazy rounded-circle group-image avatar-is-'+(participant.owner.options.online_status === 1 ? "online" : participant.owner.options.online_status === 2 ? "away" : "offline")+'" data-src="'+participant.owner.avatar.sm+'" />\n' +
                    '          <span class="h5"><span class="badge badge-light">'+participant.owner.name+'</span></span>\n' +
                    (!admin && participant.admin ? '<span title="Admin" class="badge badge-danger"><i class="fas fa-chess-king"></i></span>' : '')+
                    '         </div>\n' +
                    '       </div>\n' +
                    '  </td>'+
                    (admin ? '<td>'+templates.group_participant_permissions(participant)+'</td>' : '') +
                    '  <td>\n' +
                    '  <div class="dropdown float-right">\n' +
                    '    <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fas fa-cog"></i></button>\n' +
                    '    <div class="dropdown-menu dropdown-menu-right">\n' +
                    (admin && !locked ? templates.admin_participant_options(participant) : '')+
                    '<a class="dropdown-item" onclick="ThreadManager.load().createPrivate({id : \''+participant.owner.provider_id+'\', alias : \''+participant.owner.provider_alias+'\'}); return false;" href="#" title="Message"><i class="fas fa-comment"></i> Message</a>' +
                    ' <span id="network_for_'+participant.owner.provider_id+'">\n' +
                        templates.thread_network_opt(participant.owner)+
                    ' </span>\n' +
                    ' </div></div></td>\n' +
                    '</tr>'
            };
            if(participants && participants.length){
                participants.forEach((participant) => {
                    if(!Messenger.isProvider(participant.owner_id, participant.owner_type)){
                        table_fill += participant_fill(participant)
                    }
                })
            }
            return table_top+table_fill+table_bot
        },
        group_add_participants : function(friends){
            let table_top = '<div class="row">\n' +
                '    <div class="col-12">\n' +
                '        <div class="table-responsive-sm">\n' +
                '            <table id="add_group_participants" class="table table-sm table-hover">\n' +
                '                <thead>\n' +
                '                <tr>\n' +
                '                    <th>Name</th>\n' +
                '                    <th><span class="float-right">Add</span></th>\n' +
                '                </tr>\n' +
                '                </thead>\n' +
                '                <tbody>',
                table_bot = '</tbody></table></div></div></div>',
                table_fill = '';
            if(friends && friends.length){
                friends.forEach((friend) => {
                    table_fill += templates.friends_fill(friend)
                })
            }
            return table_top+table_fill+table_bot
        },
        participant_permissions : function(participant){
            return '<div class="form-row">\n' +
                '<div class="col-12 mt-1 text-center">' +
                '    <div">\n' +
                '         <img alt="Avatar" height="72" width="72" class="rounded-circle avatar-is-'+(participant.owner.options.online_status === 1 ? "online" : participant.owner.options.online_status === 2 ? "away" : "offline")+'" src="'+participant.owner.avatar.sm+'"/>\n' +
                '    </div>\n' +
                '</div>' +
                '</div><hr>'+
                '<table class="table mb-0 table-sm table-hover"><tbody>\n' +
                '<tr class="'+(participant.send_messages ? 'bg-light' : '')+'">\n' +
                '<td class="pointer_area" onclick="$(\'#p_send_messages\').click()"><div class="h4 mt-1"><i class="fas fa-caret-right"></i> <span class="h5">Send Messages</span></div></td>\n' +
                '<td><div class="mt-1 float-right"><span class="switch switch-sm mt-1"><input class="switch switch_input m_setting_toggle" id="p_send_messages" name="p_send_messages" type="checkbox" '+(participant.send_messages ? 'checked' : '')+'/><label for="p_send_messages"></label></span></div></td>\n' +
                '</tr>\n' +
                '<tr class="'+(participant.add_participants ? 'bg-light' : '')+'">\n' +
                '<td class="pointer_area" onclick="$(\'#p_add_participants\').click()"><div class="h4 mt-1"><i class="fas fa-caret-right"></i> <span class="h5">Add Participants</span></div></td>\n' +
                '<td><div class="mt-1 float-right"><span class="switch switch-sm mt-1"><input class="switch switch_input m_setting_toggle" id="p_add_participants" name="p_add_participants" type="checkbox" '+(participant.add_participants ? 'checked' : '')+'/><label for="p_add_participants"></label></span></div></td>\n' +
                '</tr>\n' +
                '<tr class="'+(participant.manage_invites ? 'bg-light' : '')+'">\n' +
                '<td class="pointer_area" onclick="$(\'#p_manage_invites\').click()"><div class="h4 mt-1"><i class="fas fa-caret-right"></i> <span class="h5">Manage Invites</span></div></td>\n' +
                '<td><div class="mt-1 float-right"><span class="switch switch-sm mt-1"><input class="switch switch_input m_setting_toggle" id="p_manage_invites" name="p_manage_invites" type="checkbox" '+(participant.manage_invites ? 'checked' : '')+'/><label for="p_manage_invites"></label></span></div></td>\n' +
                '</tr>\n' +
                '<tr class="'+(participant.send_knocks ? 'bg-light' : '')+'">\n' +
                '<td class="pointer_area" onclick="$(\'#p_send_knocks\').click()"><div class="h4 mt-1"><i class="fas fa-caret-right"></i> <span class="h5">Send Knocks</span></div></td>\n' +
                '<td><div class="mt-1 float-right"><span class="switch switch-sm mt-1"><input class="switch switch_input m_setting_toggle" id="p_send_knocks" name="p_send_knocks" type="checkbox" '+(participant.send_knocks ? 'checked' : '')+'/><label for="p_send_knocks"></label></span></div></td>\n' +
                '</tr>\n' +
                '<tr class="'+(participant.start_calls ? 'bg-light' : '')+'">\n' +
                '<td class="pointer_area" onclick="$(\'#p_start_calls\').click()"><div class="h4 mt-1"><i class="fas fa-caret-right"></i> <span class="h5">Start Calls</span></div></td>\n' +
                '<td><div class="mt-1 float-right"><span class="switch switch-sm mt-1"><input class="switch switch_input m_setting_toggle" id="p_start_calls" name="p_start_calls" type="checkbox" '+(participant.start_calls ? 'checked' : '')+'/><label for="p_start_calls"></label></span></div></td>\n' +
                '</tr>\n' +
                '<tr class="'+(participant.manage_bots ? 'bg-light' : '')+'">\n' +
                '<td class="pointer_area" onclick="$(\'#p_manage_bots\').click()"><div class="h4 mt-1"><i class="fas fa-caret-right"></i> <span class="h5">Manage Bots</span></div></td>\n' +
                '<td><div class="mt-1 float-right"><span class="switch switch-sm mt-1"><input class="switch switch_input m_setting_toggle" id="p_manage_bots" name="p_manage_bots" type="checkbox" '+(participant.manage_bots ? 'checked' : '')+'/><label for="p_manage_bots"></label></span></div></td>\n' +
                '</tr>\n' +
                '</tbody></table>\n'
        },
        new_group_base : function(){
            return '<div id="thread_header_area"><div class="dropdown float-right">\n' +
                '<button onclick="ThreadManager.load().closeOpened()" title="Close" class="btn btn-lg text-danger btn-light pt-1 pb-0 px-2 mr-1" type="button"><i class="fas fa-times fa-2x"></i></button>'+
                '</div><div class="h3 fw-bold"><div class="d-inline-block mt-2 ml-2"><i class="fas fa-edit"></i> Create a group</div></div>'+
                '</div>'+
                '<div class="card messages-panel mt-1">\n' +
                '    <div class="message-body" id="thread_new_group">\n' +
                '        <div class="message-chat">\n' +
                '            <div id="msg_thread_new_group" class="chat-body pb-0 mb-0">\n'+
                '               <div id="messages_container_new_group">'+templates.loader()+'</div>\n'+
                '            </div>\n' +
                '            <div class="chat-footer">\n' +
                '                <div class="card bg-light mb-0 border-0">\n' +
                '                    <div class="col-12 mt-3 px-0">\n' +
                '                        <form class="form-inline w-100 needs-validation" action="javascript:ThreadManager.newForms().newGroup()" id="new_group_form" novalidate>\n' +
                '                            <div class="col-12">\n' +
                '                            <div class="input-group">\n' +
                '                                <input minlength="3" maxlength="50" class="form-control" id="subject" placeholder="Name the group conversation" name="subject-'+Date.now()+'" autocomplete="off" required>\n' +
                '                                <div class="input-group-append">\n' +
                '                                    <button id="make_thread_btn" class="btn btn-primary"><i class="fas fa-edit"></i> Create</button>\n' +
                '                                </div>\n' +
                '                                <div class="invalid-feedback mb-n4">Required / 3 - 50 characters</div>'+
                '                            </div>'+
                '                            </div>\n' +
                '                            <div class="col-12 my-3"></div>\n' +
                '                        </form>\n' +
                '                    </div>\n' +
                '                </div>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '    </div>\n' +
                '</div>'
        },
        search_base : function(){
            return '<div id="thread_header_area"><div class="dropdown float-right">\n' +
                '<button onclick="ThreadManager.load().closeOpened()" title="Close" class="btn btn-lg text-danger btn-light pt-1 pb-0 px-2 mr-1" type="button"><i class="fas fa-times fa-2x"></i></button>'+
                '</div><div class="h3 fw-bold">' +
                '<div class="form-inline ml-2">\n' +
                '  <div class="form-row w-100 mt-1">\n' +
                '      <input autocomplete="off" id="messenger_search_profiles" type="search" class="shadow-sm form-control w-100" placeholder="Search profiles...">\n' +
                '  </div>\n' +
                '</div></div>' +
                '</div>'+
                '<div class="card messages-panel mt-1">\n' +
                '    <div class="message-body" id="thread_new_group">\n' +
                '        <div class="message-chat mb-1">\n' +
                '            <div id="loading_thread" class="chat-body chat-special pb-0 mb-0">\n'+
                '               <ul id="messenger_search_content" class="messages-list">'+templates.thread_empty_search(false)+'</ul>\n'+
                '            </div>\n' +
                '        </div>\n' +
                '    </div>\n' +
                '</div>'
        },
        contacts : function(friends){
            let top = '<div class="'+(Messenger.common().mobile ? '' : 'px-3')+' mt-2">', bot = '</div>',
                none = '<h4 class="text-center mt-4"><span class="badge badge-pill badge-secondary"><i class="fas fa-user-friends"></i> No friends to show</span></h4>',
                table_top = '<div class="table-responsive-sm">\n' +
                    '            <table id="contact_list_table" class="table table-sm table-hover table-striped">\n' +
                    '                <thead class="bg-gradient-dark text-light">\n' +
                    '                <tr>\n' +
                    '                    <th>Name</th>\n' +
                    '                    <th><span class="float-right">Friends since</span></th>\n' +
                    '                </tr>\n' +
                    '                </thead>\n' +
                    '                <tbody>',
                table_bot = '</tbody></table></div>',
                table_fill = '';
            if(!friends || !friends.length){
                return top+none+bot;
            }
            let friend_fill = (friend) => {
                return '<tr onclick="ThreadManager.load().createPrivate({id : \''+friend.party.provider_id+'\', alias : \''+friend.party.provider_alias+'\'})" class="pointer_area">\n' +
                    '<td>\n' +
                    '    <div class="table_links">\n' +
                    '        <div class="nowrap">\n' +
                    '            <img class="lazy rounded-circle group-image avatar-is-'+(friend.party.options.online_status === 1 ? "online" : friend.party.options.online_status === 2 ? "away" : "offline")+'" data-src="'+friend.party.avatar.sm+'"/>\n' +
                    '            <span class="h5"><span class="badge badge-light">'+friend.party.name+'</span></span>\n' +
                    '         </div>\n' +
                    '     </div>\n' +
                    '</td>\n' +
                    '<td>\n' +
                    '    <div class="float-right nowrap">\n' +
                    '        <span class="mt-2 shadow-sm badge badge-pill badge-secondary"><i class="far fa-calendar-alt"></i> '+(Messenger.format().makeHumanTime(friend.created_at))+'</span>\n' +
                    '    </div>\n' +
                    '</td>\n' +
                    '</tr>'
            };
            friends.forEach((friend) => {
                table_fill += friend_fill(friend)
            });
            return top+table_top+table_fill+table_bot+bot
        },
        contacts_base : function(){
            return '<div id="thread_header_area"><div class="dropdown float-right">\n' +
                '<button onclick="ThreadManager.load().closeOpened()" title="Close" class="btn btn-lg text-danger btn-light pt-1 pb-0 px-2 mr-1" type="button"><i class="fas fa-times fa-2x"></i></button>'+
                '</div><div class="h3 fw-bold">' +
                '<div class="d-inline-block mt-2 ml-2"><i class="fas fa-user-friends"></i> Friends</div>' +
                '</div></div>'+
                '<div class="card messages-panel mt-1">\n' +
                '    <div class="message-body" id="thread_new_group">\n' +
                '        <div class="message-chat mb-1">\n' +
                '            <div id="loading_thread" class="chat-body chat-special pb-0 mb-0">\n'+
                '               <div id="messenger_contacts_ctnr">'+templates.loader()+'</div>\n'+
                '            </div>\n' +
                '        </div>\n' +
                '    </div>\n' +
                '</div>'
        },
        edit_message : function(body){
            return '<form id="edit_message_form" action="javascript:void(0)">\n' +
                '<div class="form-row mx-n2 rounded bg-light text-dark py-3 px-2 shadow-sm">\n' +
                '    <div class="col-12 mb-0">\n' +
                '         <textarea id="edit_message_textarea" style="resize: none;" rows="6" class="form-control fw-bold shadow-sm">'+body+'</textarea>' +
                '     </div>\n' +
                '</div>' +
                '<button onclick="EmojiPicker.editMessage()" style="font-size: 18px; line-height: 0;" data-bs-toggle="tooltip" title="Add emoji" data-bs-placement="top" id="edit_message_emoji_btn" type="button" class="float-right mr-n2 mt-1 p-1 btn btn-sm btn-light"><i class="fas fa-grin"></i></button>'+
                '</form>'
        },
       
        thread_base: function(data, creating){
            return `
            <div class="chat-contents">
                <div class="chat-content-wrap">
                    <div class="chat-wrap-inner">
                        <div class="chat-box">
                            <div class="chats">
                                <div class="message-body" id="thread_${(creating ? '' : data.id)}">
                                    <div id="msg_thread_${(creating ? '' : data.id)}">
                                        <div id="messages_container_${(creating ? '' : data.id)}">
                                            ${(creating ? templates.thread_new_fill(data) : templates.loader())}
                                        </div>
                                        <div id="pending_messages" class="w-100"></div>
                                        <div id="seen-by_final" class="seen-by-final bobble-zone"></div>
                                        <div id="new_message_alert" class="pointer_area NS">${templates.thread_new_message_alert()}</div>
                                        <div id="reply_message_alert" class="pointer_area NS"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="chat-footer">
                ${templates.disabled_overlay_check(data, creating)}
                <form autocomplete="off" id="thread_form">
                    <div class="message-bar">
                        <div class="message-inner">
                            <button id="file_upload_btn" data-bs-toggle="tooltip" 
                                data-bs-title="Upload File(s)" data-bs-placement="top" 
                                class="link attach-icon p-1 btn btn-sm" onclick="$('#doc_file').trigger('click')" type="button">
                            <i class="fa-solid fa-paperclip"></i>
                            </button>
                            <button id="record_audio_message_btn" data-bs-toggle="tooltip" title="Record Audio Message" data-bs-placement="top" class="p-1 mx-1 btn btn-sm btn-light" type="button"><i class="fas fa-microphone"></i></button>
                            <div class="message-area">
                                <div class="input-group">
                                    <textarea autocomplete="off" spellcheck="true" data-bs-toggle="tooltip" data-title="message" name="message_txt_${Date.now()}" id="message_text_input" class="form-control pr-special-btn" placeholder="Type message..."></textarea>
                                    <button id="add_emoji_btn" data-bs-toggle="tooltip" data-bs-title="Add Emoji" data-bs-placement="top" class="p-1 mx-1 btn btn-sm btn-custom" type="button"><i class="fas fa-grin"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <input class="NS" multiple type="file" name="doc_file" id="doc_file">
                <input class="NS" id="thread_avatar_image_file" type="file" name="group_avatar_image_file" accept="image/*">
            </div>
            `;
        },
        disabled_overlay_check : function(data, creating){
            if(creating){
                return data.options.can_message_first ? '' : templates.messages_disabled_overlay();
            }
            if('options' in data && (data.locked || !data.options.message)){
                return templates.messages_disabled_overlay();
            }
            return '';
        },
        render_private : function(data){
            return templates.thread_private_header(data) + templates.thread_base(data)
        },
        render_group : function(data){
            return templates.thread_group_header(data) + templates.thread_base(data)
        },
        render_new_private : function (data) {
            return templates.thread_new_header(data) + templates.thread_base(data, true)
        }
    };
    return {
        render : function(){
            return templates
        },
        youtubeRegex : methods.youtubeRegex,
        giphyRegex : methods.giphyRegex,
    };
}());