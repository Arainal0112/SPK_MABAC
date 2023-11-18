


<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>


<script>
    let counter = 1;

    function tambahForm() {
        counter++;

        const container = document.getElementById('form-container');

        const newForm = document.createElement('div');
        newForm.classList.add('form-group');

        const label = document.createElement('label');
        label.classList.add('form-control-label');
        label.setAttribute('for', 'sub_alt_' + counter);
        label.textContent = 'Sub Alternatif ' + counter;

        const input = document.createElement('input');
        input.setAttribute('type', 'text');
        input.setAttribute('id', 'sub_alt_' + counter);
        input.setAttribute('class', 'form-control');
        input.setAttribute('name', 'sub_alt_' + counter);
        input.setAttribute('placeholder', 'Isikan Sub Kriteria');

        newForm.appendChild(label);
        newForm.appendChild(input);

        container.appendChild(newForm);
    }
    function hapusForm() {
        if (counter > 1) {
            const container = document.getElementById('form-container');
            container.removeChild(container.lastChild);
            counter--;
        }
    }
</script>

{{-- for modal --}}
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
