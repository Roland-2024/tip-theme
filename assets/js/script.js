// Enhanced JavaScript for the football betting tips website
document.addEventListener('DOMContentLoaded', function() {
    // Mobile navigation toggle functionality
    const toggle = document.getElementById('mobileMenuToggle');
    const mobileNav = document.getElementById('mobileNavWrapper');
    const hamburger = document.querySelector('.hamburger');
  
    if (toggle && mobileNav) {
      toggle.addEventListener('click', () => {
        const isExpanded = toggle.getAttribute('aria-expanded') === 'true';
        toggle.setAttribute('aria-expanded', !isExpanded);
        mobileNav.classList.toggle('show');
        hamburger.classList.toggle('open');
      });
    }    
    
    // Current date display
    const currentDate = new Date();
    const dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const dateDisplay = document.createElement('div');
    dateDisplay.className = 'current-date';
    dateDisplay.textContent = currentDate.toLocaleDateString('en-US', dateOptions);
    
    // Add to header if needed
    // document.querySelector('header .container').appendChild(dateDisplay);
    
// If link matches the current page exactly, apply .active
const currentLocation = window.location.href.replace(/\/$/, "");
const navItems = document.querySelectorAll('nav ul li a');

navItems.forEach(item => {
  const linkUrl = item.href.replace(/\/$/, "");
  if (linkUrl === currentLocation) {
    item.classList.add('active');
  }
});
    // Read More button functionality for match analysis
    // const readMoreButtons = document.querySelectorAll('.read-more-btn');
    
    // readMoreButtons.forEach(button => {
    //     button.addEventListener('click', function() {
    //         const matchCard = this.closest('.match-card');
    //         const analysisPreview = matchCard.querySelector('.analysis-preview');
    //         const analysisFull = matchCard.querySelector('.analysis-full');
            
    //         if(analysisFull.style.display === 'block') {
    //             analysisFull.style.display = 'none';
    //             analysisPreview.style.display = 'block';
    //             this.textContent = 'Read More';
    //         } else {
    //             analysisFull.style.display = 'block';
    //             analysisPreview.style.display = 'none';
    //             this.textContent = 'Read Less';
    //         }
    //     });
    // });
    
    // Form submission handling
    const newsletterForm = document.querySelector('.newsletter form');
    if(newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const emailInput = this.querySelector('input[type="email"]');
            if(emailInput.value) {
                // In a real application, this would send the data to a server
                alert('Thank you for subscribing to our newsletter!');
                emailInput.value = '';
            }
        });
    }
    
    // Get URL parameters for match template page
    function getUrlParameter(name) {
        name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
        var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
        var results = regex.exec(location.search);
        return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
    }
    
    // If on match template page, load match data
    const matchId = getUrlParameter('id');
    if(matchId && document.querySelector('.match-template')) {
        loadMatchData(matchId);
    }
    
    // Function to load match data (would fetch from API in a real application)
    function loadMatchData(matchId) {
        // This is a placeholder. In a real application, this would fetch data from a server
        console.log('Loading match data for ID:', matchId);
        
        // For demo purposes, we'll just update the title based on the match ID
        const matchTitle = document.querySelector('.match-template h1');
        if(matchTitle) {
            if(matchId === 'man-utd-liverpool') {
                matchTitle.textContent = 'Manchester United vs Liverpool - Match Analysis';
            } else if(matchId === 'barcelona-real-madrid') {
                matchTitle.textContent = 'Barcelona vs Real Madrid - Match Analysis';
            } else if(matchId === 'bayern-dortmund') {
                matchTitle.textContent = 'Bayern Munich vs Borussia Dortmund - Match Analysis';
            }
        }
    }
});
