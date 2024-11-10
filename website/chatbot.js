async function fetchResponses() {
  const response = await fetch('responses.json');
  const responses = await response.json();
  return responses;
}

async function checkMultipleIncludes() {
  const inputElement = document.getElementById('text-input');
  const inputValue = inputElement.value.toLowerCase();
  const responses = await fetchResponses();

  const modifiers = [
    'what', 'how', 'where', 'why', 'when', 'is', 'type', 'lungs', 'organs', 'liver', 'immune', 'malfunction',
    'development', 'journey', 'location', 'structure', 'function', 'origin', 'symptom', 'role', 'purpose', 'process', 'prevent', 'treat', 'risk'
  ];

  const sentences = inputValue.split(/[.!?]+/).filter(Boolean);

  const finalResponses = sentences.map(sentence => {
    let sentenceResponses = [];
    let localMatchedSubstrings = [];
    let localQuestionTypes = [];
    let hasModifier = false;

    modifiers.forEach(modifier => {
      if (sentence.includes(modifier) && !localQuestionTypes.includes(modifier)) {
        localQuestionTypes.push(modifier);
        hasModifier = true;
      }
    });

    for (const key in responses) {
      if (responses.hasOwnProperty(key) && sentence.includes(key.toLowerCase()) && !localMatchedSubstrings.includes(key)) {
        localMatchedSubstrings.push(key);
      }
    }

    const combinedResponses = localMatchedSubstrings.map(key => {
      const response = responses[key];
      const questionTypes = Object.keys(response).filter(modifier => modifiers.includes(modifier));

      if (hasModifier) {
        const result = localQuestionTypes.map(type => response[type]).filter(info => info !== undefined).join(' ').trim();
        return result ? result : `Keyword "${key}" found. No detailed information available.`;
      } else {
        const availableModifiers = questionTypes.join(', ');
        return `Keyword "${key}" found. Please provide one of the following modifiers for more detailed information: ${availableModifiers}.`;
      }
    }).join('. ');

    if (combinedResponses) {
      sentenceResponses.push(combinedResponses);
    } else {
      sentenceResponses.push('Input does not include any of the predefined substrings or question types.');
    }

    return sentenceResponses.join(' ');
  });

  const outputElement = document.getElementById('output');
  outputElement.textContent = "";
    const typed = new Typed(outputElement, {
      strings: [finalResponses.join(' ').trim()],
      typeSpeed: 40, // Speed of typing (in ms per character)
      backSpeed: 25, // Speed of backspacing (optional)
      backDelay: 1000, // Delay before typing starts again after backspacing (optional)
      startDelay: 500, // Delay before typing starts (optional)
      showCursor: false, // Show the cursor (optional)
      cursorChar: '|', // Custom cursor character (optional)
      loop: false, // Set to true to loop the typing animation (optional)
    });
}
