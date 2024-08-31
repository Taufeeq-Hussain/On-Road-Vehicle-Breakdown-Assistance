// Function to toggle a mobile navigation menu
const menuIcon = document.querySelector('.menu-icon');
const menuItems = document.querySelector('nav ul');

menuIcon.addEventListener('click', () => {
  menuIcon.classList.toggle('change');
  menuItems.classList.toggle('change');

  if (menuItems.classList.contains('change')) {
    menuItems.style.display = 'flex'; // Show the list items
  } else {
    menuItems.style.display = 'none'; // Hide the list items
  }
});






  
  // Function to display dynamic date and time
  function displayDateTime() {
    const dateTimeElement = document.getElementById('date-time');
    if (dateTimeElement) {
      const currentDate = new Date();
      const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric' };
      const formattedDate = currentDate.toLocaleDateString('en-US', options);
      dateTimeElement.textContent = formattedDate;
    }
  }
  
  // Function to handle form submission
  function handleFormSubmission(event) {
    event.preventDefault();
    const form = event.target;
    const formData = new FormData(form);
    // Add your form submission logic here
  
    // Example: Display a success message and reset the form
    displaySuccessMessage();
    form.reset();
  }
  
  // Function to display a success message after form submission
  function displaySuccessMessage() {
    const successMessage = document.getElementById('success-message');
    if (successMessage) {
      successMessage.style.display = 'block';
      // Hide the success message after 5 seconds
      setTimeout(function() {
        successMessage.style.display = 'none';
      }, 5000);
    }
  }
  
  // Function to enable smooth scrolling
  function enableSmoothScrolling() {
    const navLinks = document.querySelectorAll('nav ul li');
    for (const link of navLinks) {
      link.addEventListener('click', smoothScroll);
    }
  }
  
  // Smooth scrolling function
  function smoothScroll(event) {
    event.preventDefault();
    const targetId = event.target.getAttribute('href');
    const targetElement = document.querySelector(targetId);
    if (targetElement) {
      window.scrollTo({
        top: targetElement.offsetTop,
        behavior: 'smooth'
      });
    }
  }
  
  // Function to display a welcome message based on the time of day
  function displayWelcomeMessage() {
    const welcomeMessageElement = document.getElementById('welcome-message');
    if (welcomeMessageElement) {
      const currentHour = new Date().getHours();
      let welcomeMessage = '';
  
      if (currentHour < 12) {
        welcomeMessage = 'Good morning!';
      } else if (currentHour < 18) {
        welcomeMessage = 'Good afternoon!';
      } else {
        welcomeMessage = 'Good evening!';
      }
  
      welcomeMessageElement.textContent = welcomeMessage;
    }
  }
  
  // Form submission event listener
  const form = document.querySelector('form');
  if (form) {
    form.addEventListener('submit', handleFormSubmission);
  }
  
  // Display dynamic date and time
  displayDateTime();
  
  // Enable smooth scrolling
  enableSmoothScrolling();
  
  // Display welcome message
  displayWelcomeMessage();
  