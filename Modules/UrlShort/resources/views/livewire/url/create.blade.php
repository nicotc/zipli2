<div>
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="m-0 card-title me-2">Acortar Url</h5>
      </div>
      <div class="card-body">
        <form wire:submit.prevent="save">
            <!-- URL -->
            <div class="mb-3 col-12">
                <label class="form-label" for="Url">Url</label>
                <input type="text" id="Url" class="form-control" placeholder="https://example.com" wire:model="url">
                @error('url') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <!-- Variantes -->
            <div>
                <label class="form-label">Variantes <small>(ejemplo: Facebook)</small></label>

                @foreach ($variantes as $index => $variante)
                    <div class="mb-2 row align-items-center">
                        <div class="col-10">
                            <input type="text" class="form-control" placeholder="Descripción" wire:model="variantes.{{ $index }}.descripcion">
                            @error("variantes.{$index}.descripcion") <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-2">
                            @if(count($variantes) > 1)

                            <button type="button" class=" btn btn-icon btn-danger" wire:click="removeVariante({{ $index }})" @if(count($variantes) == 1) disabled @endif>
                                <i class="bx bx-trash"></i>
                            </button>
                            @endif
                        </div>
                    </div>
                @endforeach

                <button type="button" class="mt-2 btn btn-primary" wire:click="addVariante">Agregar opción</button>
            </div>

            <!-- Guardar -->
            <div class="mt-4 text-end">
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
        </form>

        <!-- Mensaje de éxito -->
        @if (session()->has('message'))
            <div class="mt-3 alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>

    </div>

</div>
