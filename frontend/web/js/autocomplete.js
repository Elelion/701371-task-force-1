/* jshint esversion: 6 */

$(function () {
  new autoComplete({
    data: {                              // Data src [Array, Function, Async] | (REQUIRED)
      src: async () => {
        // API key token
        const token = "e666f398-c983-4bde-8f14-e3fec900592a";
        // User search query
        const query = document.querySelector("#autoComplete").value;
        // Fetch External Data Source
        const source = await fetch(`https://www.food2fork.com/api/search?key=${token}&q=${query}`);
        // Format data into JSON
        const data = await source.json();
        // Return Fetched data
        return data.recipes;
      },
      key: ["title"],
      cache: false
    },
    query: {                               // Query Interceptor               | (Optional)
      manipulate: (query) => {
        return query.replace("pizza", "burger");
      }
    },
    sort: (a, b) => {                    // Sort rendered results ascendingly | (Optional)
      if (a.match < b.match) return -1;
      if (a.match > b.match) return 1;
      return 0;
    },
    placeHolder: "Food & Drinks...",     // Place Holder text                 | (Optional)
    selector: "#autoComplete",           // Input field selector              | (Optional)
    threshold: 3,                        // Min. Chars length to start Engine | (Optional)
    debounce: 300,                       // Post duration for engine to start | (Optional)
    searchEngine: "strict",              // Search Engine type/mode           | (Optional)
    resultsList: {                       // Rendered results list object      | (Optional)
      render: true,
      /* if set to false, add an eventListener to the selector for event type
         "autoComplete" to handle the result */
      container: source => {
        source.setAttribute("id", "food_list");
      },
      destination: document.querySelector("#autoComplete"),
      position: "afterend",
      element: "ul"
    },
    maxResults: 5,                         // Max. number of rendered results | (Optional)
    highlight: true,                       // Highlight matching results      | (Optional)
    resultItem: {                          // Rendered result item            | (Optional)
      content: (data, source) => {
        source.innerHTML = data.match;
      },
      element: "li"
    },
    noResults: () => {                     // Action script on noResults      | (Optional)
      const result = document.createElement("li");
      result.setAttribute("class", "no_result");
      result.setAttribute("tabindex", "1");
      result.innerHTML = "No Results";
      document.querySelector("#autoComplete_list").appendChild(result);
    },
    onSelection: feedback => {             // Action script onSelection event | (Optional)
      console.log(feedback.selection.value.image_url);
    }
  });
});

// **

const inputAutoComplete = document.querySelector(`#autoComplete`);
const citiesList = document.querySelector(`#cities-list`);
inputAutoComplete.addEventListener(`input`, async ({target}) => {
  if(!target.value) {
    return;
  }

  const data = await fetch(`/tasks/ajax-get-yandex-place?place=${target.value}`,
    {Method: `GET`, 'Content-Type': `json/application`})
    .then(res => res.json());

  citiesList.innerHTML = (data || []).map(({GeoObject}) => `<option value="${GeoObject.name}">`).join(``);
});