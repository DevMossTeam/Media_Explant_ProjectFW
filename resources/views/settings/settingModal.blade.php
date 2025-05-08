<!-- Modal Container -->
<div id="settings-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50">
    <div class="bg-white w-[90%] max-w-xl mx-auto mt-20 p-6 rounded shadow-lg relative">
        <div id="settings-modal-content"></div>
        <button onclick="document.getElementById('settings-modal').classList.add('hidden')"
            class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-xl">&times;</button>
    </div>
</div>

<script>
    function openSettingsModal(section = 'umum') {
        fetch(`/settings/modal/${section}`)
            .then(res => res.text())
            .then(html => {
                document.getElementById('settings-modal-content').innerHTML = html;
                document.getElementById('settings-modal').classList.remove('hidden');
                history.pushState({ modal: true }, '', `/settings/modal/${section}`);
            });
    }

    window.addEventListener('popstate', () => {
        const path = window.location.pathname;
        if (path.startsWith('/settings/modal/')) {
            const section = path.split('/').pop();
            openSettingsModal(section);
        } else {
            document.getElementById('settings-modal').classList.add('hidden');
        }
    });

    document.addEventListener('DOMContentLoaded', () => {
        const path = window.location.pathname;
        if (path.startsWith('/settings/modal/')) {
            const section = path.split('/').pop();
            openSettingsModal(section);
        }
    });
</script>
