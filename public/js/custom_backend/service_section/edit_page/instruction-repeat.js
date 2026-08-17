document.addEventListener("DOMContentLoaded", function () {
    /*
    |--------------------------------------------------------------------------
    | ELEMENTS
    |--------------------------------------------------------------------------
    */

    const addBtn = document.getElementById("addInstructionBtn");

    const wrapper = document.getElementById("instructionWrapper");

    /*
    |--------------------------------------------------------------------------
    | ADD NEW INPUT
    |--------------------------------------------------------------------------
    */

    if (addBtn) {
        addBtn.addEventListener("click", function () {
            const html = `
                <div class="instruction-item mb-2">

                    <div class="input-group">

                        <input type="text"
                               name="instructions[]"
                               class="form-control"
                               placeholder="Enter instruction">

                        <div class="input-group-append">

                            <button type="button"
                                    class="btn btn-danger removeInstructionBtn">

                                <i class="fas fa-minus"></i>

                            </button>

                        </div>

                    </div>

                </div>
            `;

            wrapper.insertAdjacentHTML("beforeend", html);
        });
    }

    /*
    |--------------------------------------------------------------------------
    | REMOVE INPUT
    |--------------------------------------------------------------------------
    */

    document.addEventListener("click", function (e) {
        const removeBtn = e.target.closest(".removeInstructionBtn");

        if (!removeBtn) return;

        const items = document.querySelectorAll(".instruction-item");

        /*
        |--------------------------------------------------------------------------
        | PREVENT REMOVE LAST INPUT
        |--------------------------------------------------------------------------
        */

        if (items.length <= 1) {
            alert("At least one instruction is required");

            return;
        }

        removeBtn.closest(".instruction-item").remove();
    });
});
