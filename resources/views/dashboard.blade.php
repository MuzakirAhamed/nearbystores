<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

</head>

<body class="m-5">
    <div class="flex justify-between items-center mx-4">
        <p class="text-xl font-bold">Stores Nearby</p>
        <div class="cursor-pointer" title="Logout">
            <a href="{{ route('logout') }}">
                <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M4 4H13V9H11.5V5.5H5.5V18.5H11.5V15H13V20H4V4Z"
                            fill="#1F2328"></path>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M17.1332 11.25L15.3578 9.47463L16.4184 8.41397L20.0045 12L16.4184 15.586L15.3578 14.5254L17.1332 12.75H9V11.25H17.1332Z"
                            fill="#1F2328"></path>
                    </g>
                </svg>
            </a>
        </div>
    </div>
    <div id="nearby-stores-container">
        <p class="text-center text-gray-500">Loading nearby stores...</p>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function getPosition() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        function(position) {
                            const latitude = position.coords.latitude;
                            const longitude = position.coords.longitude;

                            axios.post('/user-location', {
                                    latitude: latitude,
                                    longitude: longitude
                                })
                                .then(response => {
                                    console.log('Nearby stores:', response.data.nearByStores);

                                    updateNearbyStores(response.data.nearByStores);
                                })
                                .catch(error => {
                                    console.error('Error fetching nearby stores:', error.response?.data ||
                                        error.message);
                                    showErrorMessage(
                                        'Could not fetch nearby stores. Please try again later.');
                                });
                        },
                        function(error) {
                            console.error("Error detecting location:", error.message);
                            showErrorMessage('Unable to access location. Please enable location services.');
                        }
                    );
                } else {
                    console.error("Geolocation is not supported by this browser.");
                    showErrorMessage('Geolocation is not supported by your browser.');
                }
            }

            function updateNearbyStores(stores) {
                const container = document.querySelector('#nearby-stores-container');

                if (!container) {
                    console.error('Container for nearby stores not found.');
                    return;
                }

                container.innerHTML = '';

                if (stores.length === 0) {
                    container.innerHTML = `
                <p class="text-center text-gray-500">No nearby stores found. Try again later.</p>
            `;
                } else {
                    const storeCards = stores.map(store => `
                <div class="p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition">
                    <h2 class="text-lg font-semibold text-gray-800">${store.store_name}</h2>
                    <p class="text-sm text-gray-600">
                        <strong>Address:</strong> ${store.address || 'Not Available'}
                    </p>
                </div>
            `).join('');

                    container.innerHTML = `
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    ${storeCards}
                </div>
            `;
                }
            }

            function showErrorMessage(message) {
                const container = document.querySelector('#nearby-stores-container');
                if (container) {
                    container.innerHTML = `<p class="text-center text-red-500">${message}</p>`;
                }
            }

            getPosition();
        });
    </script>

</body>

</html>
