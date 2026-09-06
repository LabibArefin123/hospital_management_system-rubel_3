<div class="service-form-section service-instruction-section">
    <div class="service-section-title-row">
        <div>
            <div class="service-section-title">
                <i class="fas fa-list-ul"></i>
                Instructions
            </div>
            <p class="service-section-help">
                Add clear instructions that patients should follow for this service.
            </p>
        </div>
        <button type="button" id="addInstructionBtn" class="btn btn-success service-add-instruction-btn">
            <i class="fas fa-plus"></i>
            <span>Add</span>
        </button>
    </div>
    <div id="instructionWrapper" class="service-instruction-wrapper">
        @if (old('instructions'))
            @foreach (old('instructions') as $instruction)
                <div class="instruction-item">
                    <div class="input-group">
                        <input type="text" name="instructions[]" value="{{ $instruction }}" class="form-control"
                            placeholder="Enter service instruction">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-danger removeInstructionBtn"
                                title="Remove instruction">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="instruction-item">
                <div class="input-group">
                    <input type="text" name="instructions[]" class="form-control"
                        placeholder="Enter service instruction">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-danger removeInstructionBtn" title="Remove instruction">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
