<x-mail::message>
# Halo {{ $guest->name }},

Kami dengan senang hati mengundang Anda untuk hadir di acara Pernikahan kami.
Silakan klik tombol di bawah ini untuk melihat detail undangan Anda:

<x-mail::button :url="$link">
Buka Undangan
</x-mail::button>

Terima kasih,<br>
Andrianus & Ribka
</x-mail::message>
