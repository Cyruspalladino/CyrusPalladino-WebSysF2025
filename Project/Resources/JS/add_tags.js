$(document).ready(function() {
  // Function to create a tag
  function createTag(text) {
    return $('<span class="tag"></span>').text(text).append(
      $('<span class="remove">&times;</span>').click(function() {
        $(this).parent().remove();
      })
    );
  }

  // Handle input for search terms
  $('#term-input').on('keyup', function(e) {
    let input = $(this).val().trim();
    if (e.key === 'Enter' || input.includes(',')) {
      let terms = input.split(',').map(term => term.trim()).filter(term => term !== '');
      terms.forEach(term => {
        $('#selected-terms').append(createTag(term));
      });
      $(this).val('');
    }
  });

  // Handle input for locations
  $('#location-input').on('keyup', function(e) {
    let input = $(this).val().trim();
    if (e.key === 'Enter' || input.includes(',')) {
      let terms = input.split(',').map(term => term.trim()).filter(term => term !== '');
      terms.forEach(term => {
        $('#selected-locations').append(createTag(term));
      });
      $(this).val('');
    }
  });

  // When clicking the search button
  $('#search-button').on('click', function() {
    // Gather search term tags
    let terms = [];
    $('#selected-terms .tag').each(function() {
      terms.push($(this).clone().children().remove().end().text());
    });

    // Gather location tags
    let locations = [];
    $('#selected-locations .tag').each(function() {
      locations.push($(this).clone().children().remove().end().text());
    });

    // Build query string
    let query = `terms=${encodeURIComponent(terms.join(','))}&locations=${encodeURIComponent(locations.join(','))}`;

    // Redirect to results.html
    window.location.href = `results.html?${query}`;
  });
});
