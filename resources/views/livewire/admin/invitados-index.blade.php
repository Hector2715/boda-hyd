<div>
    @if (session()->has('message'))
        <div x-data="{ show: true }" 
             x-init="setTimeout(() => show = false, 4000)" 
             x-show="show" 
             x-transition.duration.500ms
             class="alert alert-success shadow-sm mb-4" 
             role="alert">
            <strong>✨ ¡Hecho!</strong> {{ session('message') }}
        </div>
    @endif

    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-4">
            <div class="card card-metric p-3 text-center border-0">
                <span class="text-uppercase tracking-wider small fw-bold text-muted">Total Familias</span>
                <h3 class="mt-2 mb-0 fw-bold">{{ $totalFamilias }} Familias</h3>
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="card card-metric p-3 text-center border-0" style="border-left: 4px solid #c5896d !important;">
                <span class="text-uppercase tracking-wider small fw-bold text-muted">Asistentes Confirmados</span>
                <h3 class="mt-2 mb-0 fw-bold text-success">{{ $totalConfirmados }} personas</h3>
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="card card-metric p-3 text-center border-0">
                <span class="text-uppercase tracking-wider small fw-bold text-muted">Cancelaciones</span>
                <h3 class="mt-2 mb-0 fw-bold text-danger">{{ $totalCancelados }}</h3>
            </div>
        </div>
    </div>

    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3 mb-4 p-3 bg-white rounded-3 shadow-sm border border-light">
        <div class="input-group" style="max-width: 360px;">
            <span class="input-group-text bg-light border-end-0 text-muted">🔍</span>
            <input type="text" wire:model.live="search" class="form-control bg-light border-start-0 ps-0" placeholder="Buscar familia o apellido...">
        </div>
        <button type="button" 
            wire:click="iniciarCreacionManual"
            data-bs-target="#modalFormulario" 
            data-bs-toggle="modal"
            class="btn btn-primary px-4 py-2 fw-bold">
            + Registro Manual
        </button>
    </div>

    <div class="table-wedding-container bg-white">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Familia / Grupo</th>
                        <th class="text-center">Asistentes</th>
                        <th class="text-center">Estado</th>
                        <th>Fecha Confirmación</th>
                        <th class="text-center pe-4">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($invitados as $invitado)
                        <tr>
                            <td class="fw-bold ps-4 text-dark">{{ $invitado->nombre_familia }}</td>
                            <td class="text-center fw-bold fs-5">{{ $invitado->asistira ? $invitado->cupos_confirmados : 0 }}</td>
                            <td class="text-center">
                                @if($invitado->asistira)
                                    <span class="badge rounded-pill px-3 py-2 bg-success-subtle text-success fw-bold">✓ Confirmado</span>
                                @else
                                    <span class="badge rounded-pill px-3 py-2 bg-danger-subtle text-danger fw-bold">✗ Canceló</span>
                                @endif
                            </td>
                            <td class="text-secondary small">
                                {{ $invitado->confirmado_el ? \Carbon\Carbon::parse($invitado->confirmado_el)->translatedFormat('d F Y, g:i A') : 'N/A' }}
                            </td>
                            <td class="text-center pe-4">
                                <button type="button" wire:click="seleccionarFamilia({{ $invitado->id }})" class="btn btn-sm btn-outline-secondary me-2 px-3">
                                    👁️ Ver / Editar
                                </button>
                                <button type="button" wire:click="eliminarInvitado({{ $invitado->id }})" wire:confirm="¿Deseas eliminar este registro?" class="btn btn-sm btn-link text-danger p-0 align-middle">
                                    🗑️
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-5 fs-6">
                                Ningún invitado registrado aún.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($invitados->hasPages())
            <div class="p-3 border-top bg-light">
                {{ $invitados->links() }}
            </div>
        @endif
    </div>

         
        <div class="modal fade" id="modalFormulario" tabindex="-1" wire:ignore.self aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content border-0 shadow-lg" style="border-radius: 15px; background: #ffffff;">
                    
                    <div class="modal-header border-0 pb-0">
                        <h5 class="modal-title fw-bold text-dark">
                            {{ $isEditing ? '📝 Modificar Datos de Familia' : '➕ Registro Manual' }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form wire:submit.prevent="guardar">
                        <div class="modal-body py-3 text-start">
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted text-uppercase">Nombre de la Familia / Grupo</label>
                                <input type="text" wire:model="nombre_familia" class="form-control bg-light">
                                @error('nombre_familia') <span class="text-danger small d-block mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted text-uppercase">Nombres de los asistentes</label>
                                <textarea wire:model="nombres_asistentes" class="form-control bg-light" rows="3"></textarea>
                                @error('nombres_asistentes') <span class="text-danger small d-block mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-6">
                                    <label class="form-label small fw-bold text-muted text-uppercase">¿Cuántos pases?</label>
                                    <input type="number" wire:model="cupos_confirmados" class="form-control bg-light" min="1">
                                    @error('cupos_confirmados') <span class="text-danger small d-block mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-6">
                                    <label class="form-label small fw-bold text-muted text-uppercase">¿Asistirá?</label>
                                    <select wire:model="asistira" class="form-select bg-light">
                                        <option value="1">Sí (Confirmado)</option>
                                        <option value="0">No (Canceló)</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-2">
                                <label class="form-label small fw-bold text-muted text-uppercase">Nota interna / Mensaje (Opcional)</label>
                                <input type="text" wire:model="mensaje_novios" class="form-control bg-light">
                            </div>
                        </div>

                        <div class="modal-footer border-0 pt-0">
                            <button type="button" 
                                    class="btn btn-sm btn-light border px-3 py-2 fw-bold text-muted" 
                                    data-bs-dismiss="modal" 
                                    wire:loading.attr="disabled">
                                Cancelar
                            </button>
                            
                            <button type="submit" 
                                    class="btn btn-sm btn-primary px-4 py-2 fw-bold d-inline-flex align-items-center gap-2" 
                                    wire:loading.attr="disabled">
                                
                                <span wire:loading class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                <span wire:loading>{{ $isEditing ? 'Guardando Cambios...' : 'Registrando Familia...' }}</span>

                                <span wire:loading.remove>
                                    {{ $isEditing ? 'Guardar Cambios' : 'Registrar Familia' }}
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>