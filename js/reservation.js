// Pricing Configuration
const PRICING = {
    km: {
        rate: 2.5,
        minFee: 30,
        threshold: 100,
        reducedRate: 2.2
    },
    hour: {
        firstHour: 100,
        additionalHours: 60
    }
};

// DOM Elements
const form = document.getElementById('reservationForm');
const kmInputGroup = document.getElementById('kmInputGroup');
const hourInputGroup = document.getElementById('hourInputGroup');
const toggleBtns = document.querySelectorAll('.toggle-btn');
const distanceRange = document.getElementById('distanceRange');
const distanceInput = document.getElementById('distance');
const hoursInput = document.getElementById('hours');
const dateInput = document.getElementById('date');
const timeInput = document.getElementById('time');

// Initialize
document.addEventListener('DOMContentLoaded', () => {
    // Set selected vehicle from URL
    const params = new URLSearchParams(window.location.search);
    document.getElementById('selectedVehicle').value = params.get('vehicle') || 'Non spécifié';

    // Set default date/time
    const now = new Date();
    dateInput.valueAsDate = now;
    timeInput.value = `${String(now.getHours()).padStart(2, '0')}:${String(now.getMinutes()).padStart(2, '0')}`;

    // Sync range and number inputs
    distanceRange.addEventListener('input', updateDistanceInput);
    distanceInput.addEventListener('input', updateDistanceRange);
    
    // Hour input listener
    hoursInput.addEventListener('input', calculateFee);

    // Default to KM mode
    toggleMode('km');
});

function updateDistanceInput() {
    distanceInput.value = distanceRange.value;
    calculateFee();
}

function updateDistanceRange() {
    distanceRange.value = distanceInput.value;
    calculateFee();
}

// Toggle KM/Hour
toggleBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        const mode = btn.dataset.mode;
        toggleBtns.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        toggleMode(mode);
    });
});

function toggleMode(mode) {
    if (mode === 'km') {
        kmInputGroup.classList.remove('hidden');
        hourInputGroup.classList.add('hidden');
        distanceRange.disabled = false;
        distanceInput.disabled = false;
    } else {
        kmInputGroup.classList.add('hidden');
        hourInputGroup.classList.remove('hidden');
    }
    calculateFee();
}

// Fee Calculation
function calculateFee() {
    const isKmMode = document.querySelector('.toggle-btn.active').dataset.mode === 'km';
    let fee = 0;

    if (isKmMode) {
        const distance = parseFloat(distanceInput.value) || 0;
        const { rate, minFee, threshold, reducedRate } = PRICING.km;
        
        fee = distance <= threshold 
            ? Math.max(minFee, distance * rate)
            : (threshold * rate) + ((distance - threshold) * reducedRate);
    } else {
        const hours = parseFloat(hoursInput.value) || 0;
        const { firstHour, additionalHours } = PRICING.hour;
        
        fee = hours <= 1 ? firstHour : firstHour + ((hours - 1) * additionalHours);
    }

    document.getElementById('fee').textContent = `${fee.toFixed(2)}€`;
}

// Form Submission
form.addEventListener('submit', (e) => {
    e.preventDefault();
    saveReservation();
});

// ... (keep all existing code until saveReservation function)

function saveReservation() {
    const reservation = {
        date: new Date().toISOString(),
        pickupDate: dateInput.value,
        pickupTime: timeInput.value,
        cin: document.getElementById('cin').value,
        fullName: document.getElementById('fullName').value,
        phone: document.getElementById('phone').value,
        email: document.getElementById('email').value || 'N/A',
        vehicle: document.getElementById('selectedVehicle').value,
        mode: document.querySelector('.toggle-btn.active').dataset.mode,
        distance: distanceInput.value,
        hours: hoursInput.value,
        fee: document.getElementById('fee').textContent
    };

    // Append to pending.csv
    appendToPendingCSV(reservation);
    alert('Réservation confirmée! Les détails ont été ajoutés à pending.csv');
    form.reset();
}

function appendToPendingCSV(data) {
    const csvRow = [
        `"${data.date}"`,
        `"${data.pickupDate}"`,
        `"${data.pickupTime}"`,
        `"${data.cin}"`,
        `"${data.fullName}"`,
        `"${data.phone}"`,
        `"${data.email}"`,
        `"${data.vehicle}"`,
        `"${data.mode}"`,
        `"${data.distance}"`,
        `"${data.hours}"`,
        `"${data.fee}"`
    ].join(',');

    // Create download link with all existing + new data
    let csvContent = localStorage.getItem('pending_csv') || 
        '"Timestamp","Date","Heure","CIN","Nom complet","Téléphone","Email","Véhicule","Mode","Distance (km)","Heures","Total"\n';
    
    csvContent += csvRow + "\n";
    localStorage.setItem('pending_csv', csvContent);
    
    // Trigger download
    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    const url = URL.createObjectURL(blob);
    const link = document.createElement('a');
    link.href = url;
    link.setAttribute('download', 'pending.csv');
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    URL.revokeObjectURL(url);
}