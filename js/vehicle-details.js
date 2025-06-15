// Vehicle Data
const vehicles = [
    {
        name: "Mercedes Luxury Van",
        image: "mercedesVan.jfif",
        description: "Fourgonnette VIP spacieuse avec sièges en cuir.",
        passengers: 8,
        bags: 6
    },
    {
        name: "Tesla Model Y",
        image: "teslaY.webp",  // First image extension
        description: "SUV premium écologique avec autopilote.",
        passengers: 5,
        bags: 4
    },
    {
        name: "Sedan Mystérieux",
        image: "mystrious.jpg",  // Single image
        description: "Véhicule haut de gamme pour clients exclusifs.",
        passengers: 4,
        bags: 3
    }
];

function loadVehicleDetails() {
    const urlParams = new URLSearchParams(window.location.search);
    const vehicleSlug = urlParams.get('vehicle');
    
    if (!vehicleSlug) {
        window.location.href = 'products.html';
        return;
    }

    // Find vehicle by slugified name
    const vehicle = vehicles.find(v => 
        v.name.toLowerCase().replace(/\s+/g, '-') === vehicleSlug
    );

    if (!vehicle) {
        window.location.href = 'products.html';
        return;
    }

    // Update page content
    document.getElementById('vehicle-name').textContent = vehicle.name;
    document.getElementById('vehicle-description').textContent = vehicle.description;
    document.getElementById('vehicle-passengers').textContent = `${vehicle.passengers} passagers`;
    document.getElementById('vehicle-bags').textContent = `${vehicle.bags} bagages`;
    document.getElementById('reserve-btn').href = `reservation.html?vehicle=${encodeURIComponent(vehicle.name)}`;

    const folderName = vehicle.image.split('.')[0];
    const thumbnailContainer = document.getElementById('thumbnail-container');
    thumbnailContainer.innerHTML = '';  // Clear thumbnails

    // Handle Sedan Mystérieux (single image)
    if (vehicle.name === "Sedan Mystérieux") {
        document.getElementById('main-image').src = `assets/vehicles/${vehicle.image}`;
        thumbnailContainer.style.display = 'none';  // Hide thumbnails
        return;
    }

    // Handle Tesla/Mercedes (multiple images)
    const extensions = {
        "teslaY": ["1.jpg", "2.afiv", "3.webp"],  // Your actual Tesla files
        "mercedesVan": ["1.jfif", "2.jpg", "3.jpg"]
    };

    extensions[folderName].forEach((file, index) => {
        const img = document.createElement('img');
        img.src = `assets/vehicles/${folderName}/${file}`;
        img.alt = `${vehicle.name} ${index + 1}`;
        
        img.addEventListener('click', () => {
            document.getElementById('main-image').src = img.src;
            // Highlight active thumbnail
            document.querySelectorAll('#thumbnail-container img').forEach(thumb => {
                thumb.classList.remove('active');
            });
            img.classList.add('active');
        });
        
        thumbnailContainer.appendChild(img);
    });

    // Set first image as active
    if (thumbnailContainer.firstChild) {
        thumbnailContainer.firstChild.classList.add('active');
        document.getElementById('main-image').src = thumbnailContainer.firstChild.src;
    }
}

document.addEventListener('DOMContentLoaded', loadVehicleDetails);