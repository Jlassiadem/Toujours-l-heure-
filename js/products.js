// Vehicle Data
const vehicles = [
    {
        name: "Mercedes Luxury Van",
        image: "mercedesVan.jfif",
        description: "Fourgonnette VIP spacieuse avec sièges en cuir.",
        pricePerKm: 2.5,
        pricePerHour: 80,
        passengers: 8,
        bags: 6
    },
    {
        name: "Tesla Model Y",
        image: "teslaY.webp",
        description: "SUV premium écologique avec autopilote.",
        pricePerKm: 2.5,
        pricePerHour: 80,
        passengers: 5,
        bags: 4
    },
    {
        name: "Sedan Mystérieux",
        image: "mystrious.jpg",
        description: "Véhicule haut de gamme pour clients exclusifs.",
        pricePerKm: 2.5,
        pricePerHour: 80,
        passengers: 4,
        bags: 3
    }
];

// Render Vehicles with Click Handling
function renderVehicles() {
    const grid = document.getElementById('vehicle-grid');
    if (!grid) return;

    grid.innerHTML = vehicles.map(vehicle => {
        const vehicleSlug = vehicle.name.toLowerCase().replace(/\s+/g, '-');
        return `
        <div class="vehicle-card" data-vehicle="${vehicleSlug}">
            <div class="overflow-hidden">
                <img src="assets/vehicles/${vehicle.image}" alt="${vehicle.name}" 
                     class="vehicle-image">
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold mb-2">${vehicle.name}</h3>
                <div class="star-rating">
                    ${'<i class="fas fa-star"></i>'.repeat(5)}
                </div>
                <p class="text-gray-600 mb-4">${vehicle.description}</p>
                <div class="flex justify-between items-center">
                    <span class="text-blue-600 font-bold">${vehicle.passengers} passagers</span>
                    <a href="reservation.html?vehicle=${encodeURIComponent(vehicle.name)}" 
                       class="reservation-btn">
                        Réserver
                    </a>
                </div>
            </div>
        </div>
        `;
    }).join('');

    // Add click handlers
    document.querySelectorAll('.vehicle-card').forEach(card => {
        card.addEventListener('click', (e) => {
            if (!e.target.closest('.reservation-btn')) {
                const vehicleSlug = card.getAttribute('data-vehicle');
                window.location.href = `vehicle-details.html?vehicle=${vehicleSlug}`;
            }
        });
    });
}

document.addEventListener('DOMContentLoaded', renderVehicles);