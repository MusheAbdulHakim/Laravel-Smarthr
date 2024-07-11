import { EmojiButton } from '@joeattardi/emoji-button/dist';

window.EmojiPicker = (function () {
    var opt = {
            lock : true,
            reactionPicker : null,
            reactionMessageId : null,
            reactionMessageElm : null,
            messagePicker : null,
            messageTextElm : null,
            editPicker : null,
            editPickerBtn : null,
            editPickerTextEml : null,
            botReactionPicker : null,
            botReactionBtn : null,
            botReactionElm : null,
            botReactionBombPicker : null,
            botReactionBombIndex : 0,
    },
    mounted = {
        Initialize : function () {
            opt.lock = false;
        },
    },
    methods = {
        updateThemes : function(dark){
            if(opt.reactionPicker !== null){
                opt.reactionPicker.setTheme(dark ? 'dark' : 'light')
            }
            if(opt.messagePicker !== null){
                opt.messagePicker.setTheme(dark ? 'dark' : 'light')
            }
            if(opt.editPicker !== null){
                opt.editPicker.setTheme(dark ? 'dark' : 'light')
            }
            if(opt.botReactionPicker !== null){
                opt.botReactionPicker.setTheme(dark ? 'dark' : 'light')
            }
            if(opt.botReactionBombPicker !== null){
                opt.botReactionBombPicker.setTheme(dark ? 'dark' : 'light')
            }
        },
        addReaction : function(messageId){
            if(opt.reactionPicker === null){
                opt.reactionPicker = new EmojiButton({
                    theme: Messenger.common().dark_mode ? 'dark' : 'light',
                });
                opt.reactionPicker.on('emoji', methods.sendReaction);
                opt.reactionPicker.on('hidden', methods.reactionPickerHidden);
            }
            if(opt.reactionMessageId !== null){
                opt.reactionPicker.hidePicker();
                setTimeout(function(){
                    methods.addReaction(messageId)
                }, 500);
                return;
            }
            opt.reactionMessageId = messageId;
            opt.reactionMessageElm = document.getElementById('message_'+messageId).getElementsByClassName('message-body')[0];
            opt.reactionMessageElm.classList.add('shadow-primary');
            opt.reactionPicker.showPicker(opt.reactionMessageElm);
        },
        addMessage : function(){
            if(opt.messagePicker === null){
                opt.messagePicker = new EmojiButton({
                    theme: Messenger.common().dark_mode ? 'dark' : 'light',
                    autoHide : false,
                    position: 'top-end'
                });
                opt.messagePicker.on('emoji', methods.messageSelection);
            }
            opt.messageTextElm = document.getElementById('message_text_input');
            opt.messagePicker.showPicker(opt.messageTextElm);
        },
        editMessage : function(){
            if(opt.editPicker === null){
                opt.editPicker = new EmojiButton({
                    theme: Messenger.common().dark_mode ? 'dark' : 'light',
                    autoHide : false,
                    position: 'bottom-end'
                });
                opt.editPicker.on('emoji', methods.editSelection);
            }
            opt.editPickerTextEml = document.getElementById('edit_message_textarea');
            opt.editPickerBtn = document.getElementById('edit_message_emoji_btn');
            opt.editPicker.showPicker(opt.editPickerBtn);
        },
        botActionReact : function(){
            if(opt.botReactionPicker === null){
                opt.botReactionPicker = new EmojiButton({
                    theme: Messenger.common().dark_mode ? 'dark' : 'light',
                });
                opt.botReactionPicker.on('emoji', methods.botReactSelection);
            }
            opt.botReactionElm = document.getElementById('g_s_bot_reaction');
            opt.botReactionBtn = document.getElementById('bot_reaction_emoji_btn');
            opt.botReactionPicker.showPicker(opt.botReactionBtn);
        },
        botActionReactBomb : function(index){
            opt.botReactionBombIndex = index;
            if(opt.botReactionBombPicker === null){
                opt.botReactionBombPicker = new EmojiButton({
                    theme: Messenger.common().dark_mode ? 'dark' : 'light',
                });
                opt.botReactionBombPicker.on('emoji', methods.botReactBombSelection);
            }
            opt.botReactionBombPicker.showPicker(document.getElementById('bot_reaction_bomb_btn_'+index));
        },
        resetBotActionReactBomb : function(index){
            document.getElementById('bot_reaction_bomb_'+index).value = '';
        },
        sendReaction : function(selection){
            ThreadManager.addNewReaction({
                message_id : opt.reactionMessageId,
                emoji : selection.emoji
            });
        },
        reactionPickerHidden : function(){
            if(opt.reactionMessageElm !== null){
                opt.reactionMessageElm.classList.remove('shadow-primary');
            }
            opt.reactionMessageId = null;
            opt.reactionMessageElm = null;
        },
        messageSelection : function(selection){
            let curPos = opt.messageTextElm.selectionStart;
            let curVal = opt.messageTextElm.value;
            opt.messageTextElm.value = curVal.slice(0,curPos)+selection.emoji+curVal.slice(curPos)
        },
        editSelection : function(selection){
            let curPos = opt.editPickerTextEml.selectionStart;
            let curVal = opt.editPickerTextEml.value;
            opt.editPickerTextEml.value = curVal.slice(0,curPos)+selection.emoji+curVal.slice(curPos)
        },
        botReactSelection : function(selection){
            opt.botReactionElm.value = selection.emoji;
        },
        botReactBombSelection : function(selection){
            document.getElementById('bot_reaction_bomb_'+opt.botReactionBombIndex).value = selection.emoji;
        }
    };
    return {
        init : mounted.Initialize,
        addReaction : methods.addReaction,
        addMessage : methods.addMessage,
        editMessage : methods.editMessage,
        botActionReact : methods.botActionReact,
        botActionReactBomb : methods.botActionReactBomb,
        resetBotActionReactBomb : methods.resetBotActionReactBomb,
        updateThemes : methods.updateThemes,
        lock : function(arg){
            if(typeof arg === 'boolean') opt.lock = arg
        }
    };
}());