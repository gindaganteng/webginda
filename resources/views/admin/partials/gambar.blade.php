<div class="fg">
    <span class="lbl">Gambar</span>
    <label for="gambar" class="drop" id="drop">
        <input type="file" id="gambar" name="gambar" accept="image/png,image/jpeg">
        <span class="drop-empty" id="dropEmpty" @if ($gambarUrl) hidden @endif>
            <i class="fa-regular fa-image"></i>
            <strong>Klik atau drag gambar ke sini</strong>
            <small>PNG, JPG UP TO 5MB</small>
        </span>
        <img id="preview" alt="Pratinjau gambar" src="{{ $gambarUrl }}" @if (! $gambarUrl) hidden @endif>
    </label>
    @error('gambar')<div class="field-error">{{ $message }}</div>@enderror
</div>

@push('scripts')
<script>
    const input = document.getElementById('gambar');
    const drop = document.getElementById('drop');
    const preview = document.getElementById('preview');
    const empty = document.getElementById('dropEmpty');

    function tampil(file) {
        if (!file) return;
        if (file.size > 5 * 1024 * 1024) {
            alert('Ukuran gambar maksimal 5MB.');
            input.value = '';
            return;
        }
        preview.src = URL.createObjectURL(file);
        preview.hidden = false;
        empty.hidden = true;
    }

    input.addEventListener('change', function () { tampil(input.files[0]); });
    ['dragenter', 'dragover'].forEach(function (e) {
        drop.addEventListener(e, function (ev) { ev.preventDefault(); drop.classList.add('over'); });
    });
    ['dragleave', 'drop'].forEach(function (e) {
        drop.addEventListener(e, function (ev) { ev.preventDefault(); drop.classList.remove('over'); });
    });
    drop.addEventListener('drop', function (ev) {
        const f = ev.dataTransfer.files[0];
        if (f) {
            const dt = new DataTransfer();
            dt.items.add(f);
            input.files = dt.files;
            tampil(f);
        }
    });
</script>
@endpush