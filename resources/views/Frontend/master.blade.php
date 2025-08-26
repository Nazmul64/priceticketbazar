
@include('Frontend.header')
<!-- Main Section -->
<main>
    @yield('content')
</main>


@include('Frontend.footer')
        <!-- Countdown Script -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const countdownEl = document.getElementById('countdown-{{ $item->id }}');
                const drawDate = new Date("{{ $item->draw_date }}");

                function format12Hour(date) {
                    let hours = date.getHours();
                    const minutes = date.getMinutes();
                    const seconds = date.getSeconds();
                    const ampm = hours >= 12 ? 'PM' : 'AM';
                    hours = hours % 12 || 12;
                    return `${hours.toString().padStart(2,'0')}:${minutes.toString().padStart(2,'0')}:${seconds.toString().padStart(2,'0')} ${ampm}`;
                }

                function updateCountdown() {
                    const now = new Date();
                    const diff = drawDate - now;

                    if (diff <= 0) {
                        countdownEl.textContent = '🎉 Draw time has arrived!';
                        return;
                    }

                    const days = Math.floor(diff / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((diff % (1000 * 60)) / 1000);

                    countdownEl.textContent = `⏳ ${days}d ${hours}h ${minutes}m ${seconds}s | Draw: ${format12Hour(drawDate)}`;
                }

                updateCountdown();
                setInterval(updateCountdown, 1000);
            });
        </script>
        <script>
document.addEventListener("DOMContentLoaded", function () {
    const textElement = document.getElementById("about-text");
    const button = document.getElementById("toggle-btn");

    let fullText = textElement.innerText.trim();
    let words = fullText.split(" ");
    let shortText = words.slice(0, 50).join(" ") + (words.length > 100 ? "..." : "");

    let isExpanded = false;

    // Start with short text
    textElement.innerText = shortText;

    button.addEventListener("click", function () {
        if (!isExpanded) {
            textElement.innerText = fullText;
            button.innerText = "Read Less";
            isExpanded = true;
        } else {
            textElement.innerText = shortText;
            button.innerText = "Read More";
            isExpanded = false;
        }
    });
});
</script>
<style>
    .lottery-item {
        list-style: none;
        margin: 10px 0;
        padding: 10px;
        background: #f8f9fa;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .lottery-item .name {
        font-weight: 600;
        font-size: 16px;
    }
    .countdown {
        font-family: monospace;
        color: #5309c9;
        font-weight: bold;
    }
</style>
