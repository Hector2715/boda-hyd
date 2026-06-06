<div>
    <h4 class="fw-semibold text-primary mb-3">Hola, {{ $invitado->nombre_familia }}</h4>
    <p class="text-muted small">Tienes asignado un máximo de <strong>{{ $invitado->cupos_max }} pases</strong>.</p>

    <form wire:submit.prevent="guardarRsvp">
        
        <div class="mb-4">
            <label class="form-label d-block fw-bold">¿Podremos contar con tu presencia?</label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" wire:model.live="asistira" id="asiste_si" value="1">
                <label class="form-check-label" for="asiste_si">Sí, allí estaré</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" wire:model.live="asistira" id="asiste_no" value="0">
                <label class="form-check-label" for="asiste_no">Lamentablemente no puedo</label>
            </div>
            @error('asistira') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        @if($asistira === '1' || $asistira === true)
            <div class="mb-4">
                <label for="cupos_confirmados" class="form-label fw-bold">Cantidad de pases a confirmar:</label>
                <select class="form-select @error('cupos_confirmados') is-invalid @enderror" wire:model="cupos_confirmados" id="cupos_confirmados">
                    @for($i = 1; $i <= $invitado->cupos_max; $i++)
                        <option value="{{ $i }}">{{ $i }} {{ $i == 1 ? 'Persona' : 'Personas' }}</option>
                    @endfor
                </select>
                @error('cupos_confirmados') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        @endif

        <div class="mb-4">
            <label for="mensaje_novios" class="form-label fw-bold">Déjales un mensaje a los novios (Opcional):</label>
            <textarea class="form-textarea form-control @error('mensaje_novios') is-invalid @enderror" 
                      wire:model="mensaje_novios" 
                      id="mensaje_novios" 
                      rows="3" 
                      placeholder="Escribe tus buenos deseos o alguna restricción alimentaria..."></textarea>
            @error('mensaje_novios') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary btn-lg fw-bold shadow-sm">
                <span wire:loading.remove>Confirmar Respuesta</span>
                <span wire:loading class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                <span wire:loading>Procesando...</span>
            </button>
        </div>

    </form>

    @if($invitado->confirmado_el)
        <div class="alert alert-success mt-4 text-center fw-semibold" role="alert">
            ¡Tu respuesta ha sido guardada con éxito! Gracias por confirmar.
        </div>
    @endif
</div>