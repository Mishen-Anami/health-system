const API_BASE_URL = 'http://localhost:8000/api';
let token = null;

// Helper function for API requests
async function apiRequest(endpoint, method = 'GET', data = null) {
    if (!token) throw new Error('Not authenticated');
    const headers = {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${token}`, // Fixed template literal
    };
    const config = { method, headers };
    if (data) config.body = JSON.stringify(data);

    try {
        const response = await fetch(`${API_BASE_URL}${endpoint}`, config); // Fixed template literal
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
    } catch (error) {
        console.error('API Request Failed:', error);
        throw error;
    }
}

// Login
document.getElementById('loginForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    try {
        const response = await fetch(`${API_BASE_URL}/login`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ email, password }),
        });
        const data = await response.json();
        if (data.token) {
            token = data.token;
            document.getElementById('loginCard').style.display = 'none';
            document.getElementById('mainContent').style.display = 'block';
            alert('Login successful!');
        } else {
            alert('Login failed: ' + data.error);
        }
    } catch (error) {
        alert('Error logging in: ' + error.message);
    }
});

// Create Program
document.getElementById('programForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const name = document.getElementById('programName').value;
    const description = document.getElementById('programDescription').value;

    try {
        await apiRequest('/programs', 'POST', { name, description });
        alert('Program created!');
        e.target.reset();
    } catch (error) {
        alert('Error creating program: ' + error.message);
    }
});

// Register Client
document.getElementById('clientForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const data = {
        first_name: document.getElementById('firstName').value,
        last_name: document.getElementById('lastName').value,
        email: document.getElementById('email').value,
        phone: document.getElementById('phone').value,
        date_of_birth: document.getElementById('dob').value,
    };

    try {
        await apiRequest('/clients', 'POST', data);
        alert('Client registered!');
        e.target.reset();
    } catch (error) {
        alert('Error registering client: ' + error.message);
    }
});

// Enroll Client
document.getElementById('enrollmentForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const data = {
        client_id: document.getElementById('clientId').value,
        program_id: document.getElementById('programId').value,
        enrollment_date: new Date().toISOString().split('T')[0],
    };

    try {
        await apiRequest('/enrollments', 'POST', data);
        alert('Client enrolled!');
        e.target.reset();
    } catch (error) {
        alert('Error enrolling client: ' + error.message);
    }
});

// Search Clients
document.getElementById('searchInput').addEventListener('input', async (e) => {
    const query = e.target.value;
    try {
        const clients = await apiRequest(`/clients?search=${query}`); // Fixed template literal
        const clientList = document.getElementById('clientList');
        clientList.innerHTML = clients.map(client => `
            <div class="card mb-2">
                <div class="card-body">
                    ${client.first_name} ${client.last_name} (${client.email})
                </div>
            </div>
        `).join('');
    } catch (error) {
        document.getElementById('clientList').innerHTML = '<p>Error searching clients: ' + error.message + '</p>';
    }
});

// View Client Profile
document.getElementById('viewProfileBtn').addEventListener('click', async () => {
    const clientId = document.getElementById('clientProfileId').value;
    try {
        const client = await apiRequest(`/clients/${clientId}`); // Fixed template literal
        const clientProfile = document.getElementById('clientProfile');
        clientProfile.innerHTML = `
            <h4>${client.first_name} ${client.last_name}</h4>
            <p>Email: ${client.email}</p>
            <p>Phone: ${client.phone || 'N/A'}</p>
            <p>Date of Birth: ${client.date_of_birth}</p>
            <h5>Enrolled Programs:</h5>
            <ul>
                ${client.programs.map(program => `<li>${program.name}</li>`).join('')}
            </ul>
        `;
    } catch (error) {
        document.getElementById('clientProfile').innerHTML = '<p>Error loading profile: ' + error.message + '</p>';
    }
});
