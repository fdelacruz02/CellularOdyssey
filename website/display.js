let text = document.getElementById('output');
let container = document.getElementById('gamecont');
let url = 'https://cellularodyssey.jonathanwebworks.com/displayPosition.php';

// Function to fetch JSON data with GET request
async function fetchJSON(url) {
    try {
        const response = await fetch(url, {
            method: 'GET', // Set the request method to GET
            headers: {
                'Content-Type': 'application/json', // Specify the content type
            }
        });
        
        // Check if the response status is OK (status code 200)
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        
        // Parse the JSON data
        const data = await response.json();
        return data;
    } catch (error) {
        console.error("Error fetching JSON:", error);
    }
}

async function populate() {
    await new Promise(resolve => setTimeout(resolve, 2000)); // 2-second delay
    // Fetch the JSON data
    let information = await fetchJSON(url); // Pass the URL to the function
    
    
    // Check if the information is valid and set the text content
    if (information) {
        // Clear the current content if any (to prevent overwriting with old content)
        text.textContent = '';

        // Initialize Typed.js to animate the typing effect on the fetched text
        new Typed('#output', {
            strings: [information.displaytxt], // Use the fetched text from the JSON
            typeSpeed: 40,  // Speed of typing
            backSpeed: 25,  // Speed of backspacing
            backDelay: 1000, // Delay before starting backspacing
            loop: false,    // Don't loop the animation
            showCursor: false, // Show the cursor while typing
        });

        console.log("Displaying: " + information.displaytxt);
    } else {
        text.textContent = "Failed to load message."; // Fallback message
    }
}

container.addEventListener('click', populate);
