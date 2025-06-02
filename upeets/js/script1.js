 // Adicionar efeito de piscar no banner de emergência
 const banner = document.querySelector('.emergency-banner');
 if (banner) {
     setInterval(() => {
         banner.style.background = banner.style.background === 'linear-gradient(45deg, #ff6b7a, #ff4757)' 
             ? 'linear-gradient(45deg, #ff4757, #ff6b7a)' 
             : 'linear-gradient(45deg, #ff6b7a, #ff4757)';
     }, 2000);
 }

 // Scroll suave para âncoras
 document.querySelectorAll('a[href^="#"]').forEach(anchor => {
     anchor.addEventListener('click', function (e) {
         e.preventDefault();
         const target = document.querySelector(this.getAttribute('href'));
         if (target) {
             target.scrollIntoView({
                 behavior: 'smooth',
                 block: 'start'
             });
         }
     });
 });