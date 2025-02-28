


const gujaratData = {
    'Ahmedabad': ['Ahmedabad', 'Sanand', 'Dholka', 'Viramgam', 'Detroj'],
    'Surat': ['Surat', 'Bardoli', 'Mandvi', 'Mahuva', 'Vyara'],
    'Vadodara': ['Vadodara', 'Dabhoi', 'Waghodia', 'Savli', 'Padra'],
    'Rajkot': ['Rajkot', 'Gondal', 'Jetpur', 'Dhoraji', 'Upleta'],
    'Bhavnagar': ['Bhavnagar', 'Sihor', 'Palitana', 'Talaja', 'Mahuva'],
    'Jamnagar': ['Jamnagar', 'Dwarka', 'Khambhalia', 'Lalpur', 'Kalawad'],
    'Gandhinagar': ['Gandhinagar', 'Kalol', 'Dehgam', 'Mansa'],
    'Junagadh': ['Junagadh', 'Veraval', 'Keshod', 'Manavadar', 'Vanthali'],
    'Kutch': ['Bhuj', 'Gandhidham', 'Mundra', 'Anjar', 'Mandvi'],
    'Mehsana': ['Mehsana', 'Visnagar', 'Kadi', 'Unjha', 'Vijapur'],
    'Banaskantha': ['Palanpur', 'Deesa', 'Dhanera', 'Tharad', 'Danta'],
    'Patan': ['Patan', 'Sidhpur', 'Chanasma', 'Harij', 'Radhanpur'],
    'Kheda': ['Nadiad', 'Kapadvanj', 'Mehmadabad', 'Matar', 'Thasra'],
    'Anand': ['Anand', 'Khambhat', 'Petlad', 'Sojitra', 'Umreth'],
    'Bharuch': ['Bharuch', 'Ankleshwar', 'Jambusar', 'Amod', 'Vagra'],
    'Sabarkantha': ['Himmatnagar', 'Prantij', 'Talod', 'Khedbrahma', 'Idar'],
    'Amreli': ['Amreli', 'Dhari', 'Rajula', 'Savarkundla', 'Lathi'],
    'Porbandar': ['Porbandar', 'Ranavav', 'Kutiyana'],
    'Surendranagar': ['Surendranagar', 'Wadhwan', 'Dhrangadhra', 'Limbdi', 'Chotila'],
    'Valsad': ['Valsad', 'Pardi', 'Vapi', 'Umargam', 'Dharampur'],
    'Navsari': ['Navsari', 'Gandevi', 'Chikhli', 'Vansda', 'Bilimora'],
    'Narmada': ['Rajpipla', 'Dediapada', 'Tilakwada', 'Nandod'],
    'Panchmahal': ['Godhra', 'Kalol', 'Halol', 'Morva Hadaf', 'Ghoghamba'],
    'Dahod': ['Dahod', 'Jhalod', 'Limkheda', 'Devgadh Baria', 'Garbada'],
    'Tapi': ['Vyara', 'Songadh', 'Valod', 'Uchchhal', 'Nizar'],
    'Botad': ['Botad', 'Barwala', 'Gadhada', 'Ranpur'],
    'Morbi': ['Morbi', 'Wankaner', 'Tankara', 'Maliya'],
    'Aravalli': ['Modasa', 'Bhiloda', 'Meghraj', 'Dhansura'],
    'Chhota Udaipur': ['Chhota Udaipur', 'Kavant', 'Naswadi', 'Bodeli'],
    'Mahisagar': ['Lunavada', 'Santrampur', 'Kadana', 'Virpur'],
    'Devbhoomi Dwarka': ['Khambhalia', 'Dwarka', 'Kalyanpur', 'Bhanvad'],
    'Gir Somnath': ['Veraval', 'Talala', 'Kodinar', 'Una'],
    'Dang': ['Ahwa', 'Subir', 'Waghai']
};

const districtSelect = document.getElementById('districtSelect');
const citySelect = document.getElementById('citySelect');
const selection = document.getElementById('selection');

// Populate districts dropdown
Object.keys(gujaratData).sort().forEach(district => {
    const option = document.createElement('option');
    option.value = district;
    option.textContent = district;
    districtSelect.appendChild(option);
});

// Handle district selection
districtSelect.addEventListener('change', function () {
    const selectedDistrict = this.value;

    // Reset and disable city dropdown if no district is selected
    if (!selectedDistrict) {
        citySelect.innerHTML = '<option value="">Choose a city</option>';
        citySelect.disabled = true;
        selection.style.display = 'none';
        return;
    }

    // Enable and populate city dropdown
    citySelect.disabled = false;
    citySelect.innerHTML = '<option value="">Choose a city</option>';

    // Add city options
    gujaratData[selectedDistrict].forEach(city => {
        const option = document.createElement('option');
        option.value = city;
        option.textContent = city;
        citySelect.appendChild(option);
    });
});

// Handle city selection
citySelect.addEventListener('change', function () {
    const selectedCity = this.value;
    const selectedDistrict = districtSelect.value;

    if (selectedDistrict && selectedCity) {
        selection.style.display = 'block';
        selection.textContent = `Selected: ${selectedDistrict} - ${selectedCity}`;
    } else {
        selection.style.display = 'none';
    }
});