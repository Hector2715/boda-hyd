<div>
    @if ($enviado)
        <div class="text-center py-4 px-2 animate__animated animate__fadeIn">
            <div class="fs-1 mb-3">✨🥂✨</div>
            <h4 class="fw-bold mb-2" style="color: #202b3d; font-family: sans-serif;">¡Confirmación Recibida!</h4>
            <p class="text-muted small mb-0" style="font-family: sans-serif;">
                Tu asistencia ha sido registrada con éxito. Gracias por formar parte de nuestra historia.
            </p>
        </div>
    @else
        <form wire:submit.prevent="confirmarAsistencia" class="row g-3">
            
            <div class="col-12">
                <label class="form-label">Nombre de la Familia / Grupo</label>
                <input type="text" wire:model="nombre_familia" class="form-control" placeholder="Ej. Familia Martínez Pérez">
                @error('nombre_familia') 
                    <span class="text-danger d-block mt-1" style="font-family: sans-serif; font-size: 0.75rem;">{{ $message }}</span> 
                @enderror
            </div>

            <div class="col-12">
                <label class="form-label">¿Cuántas personas confirman?</label>
                <select wire:model="cupos_confirmados" class="form-select">
                    <option value="">Selecciona una opción...</option>
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}">{{ $i }} {{ $i == 1 ? 'Persona' : 'Personas' }}</option>
                    @endfor
                </select>
                @error('cupos_confirmados') 
                    <span class="text-danger d-block mt-1" style="font-family: sans-serif; font-size: 0.75rem;">{{ $message }}</span> 
                @enderror
            </div>

            <div class="col-12">
                <label class="form-label">Nombres de los asistentes</label>
                <textarea wire:model="nombres_asistentes" class="form-control" rows="3" placeholder="Escribe el nombre completo de cada asistente..."></textarea>
                @error('nombres_asistentes') 
                    <span class="text-danger d-block mt-1" style="font-family: sans-serif; font-size: 0.75rem;">{{ $message }}</span> 
                @enderror
            </div>

            <div class="col-12">
                <label class="form-label">Mensaje para los novios (Opcional)</label>
                <input type="text" wire:model="mensaje_novios" class="form-control" placeholder="Déjanos una dedicatoria o nota especial...">
                @error('mensaje_novios') 
                    <span class="text-danger d-block mt-1" style="font-family: sans-serif; font-size: 0.75rem;">{{ $message }}</span> 
                @enderror
            </div>

            <div class="col-12 my-3">
                <div class="form-check d-flex align-items-start gap-2 ps-0">
                    <input type="checkbox" wire:model="aceptar_terminos" id="aceptar_terminos" class="form-check-input ms-0 mt-1">
                    <label class="form-check-label" for="aceptar_terminos">
                        Confirmo de manera definitiva nuestra asistencia a la boda.
                    </label>
                </div>
                @error('aceptar_terminos') 
                    <span class="text-danger d-block mt-1" style="font-family: sans-serif; font-size: 0.75rem;">{{ $message }}</span> 
                @enderror
            </div>

            <div class="col-12 mt-2">
                <button type="submit" class="btn-submit-rsvp">
                    <span wire:loading.remove wire:target="confirmarAsistencia">✨ Confirmar Asistencia</span>
                    <span wire:loading wire:target="confirmarAsistencia">Procesando...</span>
                </button>
            </div>

        </form>
    @endif
</div>