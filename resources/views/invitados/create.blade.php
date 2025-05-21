<form id="form_invitados" method="POST" action="{{ route('invitados.store', $invitacion) }}">
    @csrf
    @include('invitados._form')
</form>