document.addEventListener('DOMContentLoaded', function() {
    // ======================
    // Mobile Navigation
    // ======================
    const menuToggle = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    
    if (menuToggle && mobileMenu) {
        menuToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            // Toggle menu visibility
            const isOpening = mobileMenu.classList.contains('hidden');
            mobileMenu.classList.toggle('hidden');
            document.body.classList.toggle('menu-open', !isOpening);
            
            // Toggle menu icon
            const icon = this.querySelector('i');
            icon.classList.toggle('fa-bars', !isOpening);
            icon.classList.toggle('fa-times', isOpening);
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!mobileMenu.classList.contains('hidden') && 
                !e.target.closest('#mobile-menu') && 
                e.target.id !== 'menu-toggle') {
                mobileMenu.classList.add('hidden');
                document.body.classList.remove('menu-open');
                menuToggle.querySelector('i').classList.add('fa-bars');
                menuToggle.querySelector('i').classList.remove('fa-times');
            }
        });

        // Close menu when a link is clicked
        mobileMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', function() {
                mobileMenu.classList.add('hidden');
                document.body.classList.remove('menu-open');
                menuToggle.querySelector('i').classList.add('fa-bars');
                menuToggle.querySelector('i').classList.remove('fa-times');
            });
        });
    }

    // ======================
    // Contact Form Submission
    // ======================
    const contactForm = document.getElementById('contactForm');
    const submitBtn = document.getElementById('submitBtn');
    const submitSpinner = document.getElementById('submitSpinner');
    const formSuccess = document.getElementById('formSuccess');
    const formError = document.getElementById('formError');

    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Show loading state
            submitBtn.disabled = true;
            submitSpinner.classList.remove('hidden');
            formSuccess.classList.add('hidden');
            formError.classList.add('hidden');

            // Get form data
            const formData = {
                timestamp: new Date().toLocaleString('fr-FR', {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                }),
                email: document.getElementById('email').value.trim(),
                subject: document.getElementById('subject').value,
                message: document.getElementById('message').value.trim()
            };

            // Validate form
            if (!validateForm(formData)) {
                showError();
                submitBtn.disabled = false;
                submitSpinner.classList.add('hidden');
                return;
            }

            // Process form
            setTimeout(() => { // Simulate processing delay
                try {
                    const csvContent = createCSV(formData);
                    downloadCSV(csvContent);
                    showSuccess();
                    contactForm.reset();
                } catch (error) {
                    console.error('Form submission error:', error);
                    showError();
                } finally {
                    submitBtn.disabled = false;
                    submitSpinner.classList.add('hidden');
                }
            }, 800); // 0.8 second delay for better UX
        });
    }

    // ======================
    // Helper Functions
    // ======================
    function validateForm(data) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        if (!data.email || !emailRegex.test(data.email)) {
            formError.innerHTML = '<i class="fas fa-exclamation-circle mr-2"></i> Veuillez entrer une adresse email valide';
            return false;
        }
        
        if (!data.subject) {
            formError.innerHTML = '<i class="fas fa-exclamation-circle mr-2"></i> Veuillez sélectionner un sujet';
            return false;
        }
        
        if (!data.message || data.message.length < 10) {
            formError.innerHTML = '<i class="fas fa-exclamation-circle mr-2"></i> Le message doit contenir au moins 10 caractères';
            return false;
        }
        
        return true;
    }

    function createCSV(data) {
        const headers = ['Timestamp', 'Email', 'Subject', 'Message'];
        const row = [
            `"${data.timestamp}"`,
            `"${data.email}"`,
            `"${data.subject}"`,
            `"${data.message.replace(/"/g, '""')}"`
        ];
        return [headers.join(','), row.join(',')].join('\n');
    }

    function downloadCSV(csvContent) {
        const blob = new Blob(["\uFEFF"+csvContent], { type: 'text/csv;charset=utf-8;' });
        const url = URL.createObjectURL(blob);
        const link = document.createElement('a');
        link.href = url;
        link.download = `contact_elitevtc_${new Date().getTime()}.csv`;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        URL.revokeObjectURL(url);
    }

    function showSuccess() {
        formSuccess.innerHTML = '<i class="fas fa-check-circle mr-2"></i> Merci! Votre message a été!';}