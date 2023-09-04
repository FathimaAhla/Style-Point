/*--------------- show message ---------*/
// Select the message element
const message = document.querySelector('.message');

// Function to remove the message after a certain duration
const removeMessage = () => {
    message.style.display = 'none';
};

// Set a timeout to remove the message after 5 seconds (5000 milliseconds)
setTimeout(removeMessage, 5000);