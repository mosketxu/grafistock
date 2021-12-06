
@if($contador == 0 && $activo==true)
    <div class="px-1 bg-red-100">
@else
    <div class="px-1 bg-blue-100">
@endif
    <label for="activo">{{$partida}}</label>
    <input type="checkbox" id="activo" name="activo" wire:model="activo">
</div>
