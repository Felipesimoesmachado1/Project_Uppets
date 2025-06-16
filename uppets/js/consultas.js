  // Toggle FAQ items
  const faqQuestions = document.querySelectorAll('.faq-question');
        
  faqQuestions.forEach(question => {
      question.addEventListener('click', () => {
          const faqItem = question.parentElement;
          faqItem.classList.toggle('active');
      });
  });
  
  // Calendar day selection
  const calendarDays = document.querySelectorAll('.calendar-day.available');
  
  calendarDays.forEach(day => {
      day.addEventListener('click', () => {
          // Remove selected class from all days
          calendarDays.forEach(d => d.classList.remove('selected'));
          // Add selected class to clicked day
          day.classList.add('selected');
      });
  });
  
  // Time slot selection
  const timeSlots = document.querySelectorAll('.time-slot');
  
  timeSlots.forEach(slot => {
      slot.addEventListener('click', () => {
          // Remove selected class from all time slots
          timeSlots.forEach(s => s.classList.remove('selected'));
          // Add selected class to clicked time slot
          slot.classList.add('selected');
      });
  });
  
  // Form submission
  const appointmentForm = document.getElementById('appointment-form');
  
  appointmentForm.addEventListener('submit', (e) => {
      e.preventDefault();
      
      // In a real application, you would send the form data to a server
      // For this demo, we'll just show an alert
      alert('Seu agendamento foi recebido! Em breve entraremos em contato para confirmar.');
      
      // Reset form
      appointmentForm.reset();
  });
  document.addEventListener("DOMContentLoaded", function () {
    const calendarDays = document.querySelectorAll(".calendar-day.available");
    const timeSlots = document.querySelectorAll(".time-slot");
    const dateInput = document.getElementById("appointment-date");
    const timeInput = document.getElementById("appointment-time");

    // Manipular seleção de dia
    calendarDays.forEach(day => {
        day.addEventListener("click", () => {
            // Remover seleção anterior
            document.querySelectorAll(".calendar-day.selected").forEach(d => d.classList.remove("selected"));

            // Adicionar classe selecionada
            day.classList.add("selected");

            // Atualizar input hidden de data
            const selectedDay = day.textContent.trim();
            const monthYear = document.querySelector(".calendar-month").textContent.trim();
            const formattedDate = formatDate(selectedDay, monthYear);
            dateInput.value = formattedDate;
        });
    });

    // Manipular seleção de horário
    timeSlots.forEach(slot => {
        slot.addEventListener("click", () => {
            // Remover seleção anterior
            document.querySelectorAll(".time-slot.selected").forEach(t => t.classList.remove("selected"));

            // Adicionar classe selecionada
            slot.classList.add("selected");

            // Atualizar input hidden de horário
            timeInput.value = slot.textContent.trim();
        });
    });

    // Função para converter "11 Junho 2025" + "dia" para formato YYYY-MM-DD
    function formatDate(day, monthYear) {
        const [monthName, year] = monthYear.split(" ");
        const months = {
            "Janeiro": "01",
            "Fevereiro": "02",
            "Março": "03",
            "Abril": "04",
            "Maio": "05",
            "Junho": "06",
            "Julho": "07",
            "Agosto": "08",
            "Setembro": "09",
            "Outubro": "10",
            "Novembro": "11",
            "Dezembro": "12"
        };

        const month = months[monthName];
        const dayPadded = day.padStart(2, '0');
        return `${year}-${month}-${dayPadded}`;
    }
});
