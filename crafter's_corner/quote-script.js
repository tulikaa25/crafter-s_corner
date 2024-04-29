document.addEventListener("DOMContentLoaded", function () {
    const quotes = [
        { 
            quote: "The only way to do great work is to love what you do.", 
            author: "Steve Jobs" 
        },
        { 
            quote: "In the middle of difficulty lies opportunity.", 
            author: "Albert Einstein" 
        },
        { 
            quote: "It always seems impossible until it's done.", 
            author: "Nelson Mandela" 
        },
        { 
            quote: "Strive not to be a success, but rather to be of value.", 
            author: "Albert Einstein" 
        },
        { 
            quote: "Success is not final, failure is not fatal: It is the courage to continue that counts.", 
            author: "Winston Churchill" 
        },
        { 
            quote: "Believe you can and you're halfway there.", 
            author: "Theodore Roosevelt" 
        },
        { 
            quote: "The only way to do great work is to love what you do.", 
            author: "Steve Jobs" 
        },
        { 
            quote: "Don't watch the clock; do what it does. Keep going.", 
            author: "Sam Levenson" 
        },
        { 
            quote: "The future belongs to those who believe in the beauty of their dreams.", 
            author: "Eleanor Roosevelt" 
        },
        { 
            quote: "Success is stumbling from failure to failure with no loss of enthusiasm.", 
            author: "Winston S. Churchill" 
        },
        { 
            quote: "The only limit to our realization of tomorrow will be our doubts of today.", 
            author: "Franklin D. Roosevelt" 
        },
        { 
            quote: "It's not whether you get knocked down, it's whether you get up.", 
            author: "Vince Lombardi" 
        },
        { 
            quote: "The only person you are destined to become is the person you decide to be.", 
            author: "Ralph Waldo Emerson" 
        },
        { 
            quote: "The only limit to our realization of tomorrow will be our doubts of today.", 
            author: "Franklin D. Roosevelt" 
        },
        { 
            quote: "The road to success and the road to failure are almost exactly the same.", 
            author: "Colin R. Davis" 
        },
        { 
            quote: "Don't be afraid to give up the good to go for the great.", 
            author: "John D. Rockefeller" 
        },
        { 
            quote: "I find that the harder I work, the more luck I seem to have.", 
            author: "Thomas Jefferson" 
        },
        { 
            quote: "The only place where success comes before work is in the dictionary.", 
            author: "Vidal Sassoon" 
        },
        { 
            quote: "Success usually comes to those who are too busy to be looking for it.", 
            author: "Henry David Thoreau" 
        },
        { 
            quote: "The only limit to our realization of tomorrow will be our doubts of today.", 
            author: "Franklin D. Roosevelt" 
        },
        { 
            quote: "Success is not in what you have, but who you are.", 
            author: "Bo Bennett" 
        },
        { 
            quote: "Success is not final, failure is not fatal: It is the courage to continue that counts.", 
            author: "Winston Churchill" 
        },
        { 
            quote: "I never dreamed about success, I worked for it.", 
            author: "Estée Lauder" 
        },
        { 
            quote: "The way to get started is to quit talking and begin doing.", 
            author: "Walt Disney" 
        },
        { 
            quote: "Success is not final, failure is not fatal: It is the courage to continue that counts.", 
            author: "Winston Churchill" 
        }
    ];

    const quoteText = document.getElementById("quote-text");

    // Function to generate a random quote
    function generateRandomQuote() {
        const randomIndex = Math.floor(Math.random() * quotes.length);
        const quoteObj = quotes[randomIndex];
        quoteText.innerHTML = `${quoteObj.quote}<br>- ${quoteObj.author}`;
    }

    // Generate a quote on page load
    generateRandomQuote();

    // Optionally, set an interval to automatically change the quote at a specific time interval
    setInterval(generateRandomQuote, 5000); // Change quote every 5 seconds (adjust as needed)
});

