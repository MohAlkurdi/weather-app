<style>
    .weather-container {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 20px;
        margin: 0 auto;
        width: auto;
        background-color: #f9f9f9;
        text-align: center;
        display: flex-column;
        justify-content: center;
    }

    .weather-info {
        font-family: Arial, sans-serif;
        color: #333;
    }

    .weather-label {
        font-weight: bold;
    }
</style>

<div wire:poll>
    <div wire:model.live="city" class="weather-container">
        <div class="weather-info">
            <h1>The data for {{ $city }} will be refreshed every 2.5 seconds</h1>
            <span class="weather-label">City:</span> {{ $city }} <br />
            <span class="weather-label">Max Temp:</span> {{ $max_temp }} <br />
            <span class="weather-label">Min Temp:</span> {{ $min_temp }} <br />
            <span class="weather-label">Avg Temp:</span> {{ $avg_temp }} <br />
            <span class="weather-label">Condition:</span> {{ $condition }} <br />
        </div>
    </div>
</div>
