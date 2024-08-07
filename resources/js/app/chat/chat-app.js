import '../../echo.js'

document.addEventListener("DOMContentLoaded", (event) => {
    scrollChatDiv()
});


function scrollChatDiv()
{
    document.getElementById("chatContent").scrollTop = document.getElementById("chatContent").scrollHeight
}


/**
 *-------------------------------------------------------------
 * Emoji Picker
 *-------------------------------------------------------------
 */

const emojiButton = document.querySelector(".emoji-button");
const messageInput = $('.message-area #messageInput')
if(emojiButton){
    const emojiPicker = new EmojiButton({
    autoHide: false,
    position: "top-start",
    });
    emojiButton.addEventListener("click", (e) => {
        e.preventDefault();
        emojiPicker.togglePicker(emojiButton);
    });
    
    emojiPicker.on("emoji", (emoji) => {
       const el = messageInput[0];
       const startPos = el.selectionStart;
       const endPos = el.selectionEnd;
       const value = messageInput.val();
       const newValue = value.substring(0, startPos) + emoji + value.substring(endPos, value.length);
       messageInput.val(newValue);
       el.selectionStart = el.selectionEnd = startPos + emoji.length;
       el.focus();
    });
}



