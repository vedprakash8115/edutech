// sidebar 

const sidebarToggle = document.getElementById('sidebarToggle');
  const sidebar = document.getElementById('sidebar');
  const overlay = document.createElement('div');

  overlay.className = 'overlay';
  document.body.appendChild(overlay);

  sidebarToggle.addEventListener('click', function () {
    sidebar.classList.toggle('show');
    overlay.style.display = sidebar.classList.contains('show') ? 'block' : 'none';
  });

  overlay.addEventListener('click', function () {
    sidebar.classList.remove('show');
    overlay.style.display = 'none';
  });

// dropdowns

const dropdowns = document.querySelectorAll('.nav-item.dropdown');

dropdowns.forEach(dropdown => {
  dropdown.addEventListener('mouseenter', () => {
    dropdown.classList.add('show');
    dropdown.querySelector('.dropdown-menu').classList.add('show');
  });

  dropdown.addEventListener('mouseleave', () => {
    dropdown.classList.remove('show');
    dropdown.querySelector('.dropdown-menu').classList.remove('show');
  });
});


// Get the button
var backToTopBtn = document.getElementById("backToTopBtn");

// Show or hide the button based on scroll position
window.onscroll = function () {
  if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
    backToTopBtn.style.opacity = "1";
    backToTopBtn.style.visibility = "visible";
  } else {
    backToTopBtn.style.opacity = "0";
    backToTopBtn.style.visibility = "hidden";
  }
};

// Scroll to the top when the button is clicked
backToTopBtn.onclick = function () {
  window.scrollTo({
    top: 0,
    behavior: "smooth",
  });
};
  const words = ["Courses", "Programs", "Lessons", "Workshops"];
  let index = 0;
  let charIndex = 0;
  let deleting = false;
  const typingSpeed = 150;  
  const deletingSpeed = 100;
  const pauseBetweenWords = 1000; 
  const changingWordElement = document.getElementById("changing-word");

  function typeWord() {
    const currentWord = words[index];
    if (!deleting && charIndex <= currentWord.length) {
      changingWordElement.innerText = currentWord.slice(0, charIndex++);
    }
    if (deleting && charIndex >= 0) {
      changingWordElement.innerText = currentWord.slice(0, charIndex--);
    }

    if (!deleting && charIndex === currentWord.length) {
      setTimeout(() => deleting = true, pauseBetweenWords);
    }

    if (deleting && charIndex === 0) {
      deleting = false;
      index = (index + 1) % words.length; 
    }

    setTimeout(typeWord, deleting ? deletingSpeed : typingSpeed);
  }

  typeWord();

  