<x-layout>
<div class="container-fluid mt-2 mb-2 bg-light">
    <div class="row">
        <form method="POST" action="{{ route('pdf.generate') }}" enctype="multipart/form-data">
            @csrf
            <div class="col-md-12">
                <div class="p-3 text-zinc-500 text-center">
                    <h1><p class="font-bold">Personal Data</p></h1>
                </div>
                <table class="table table-bordered bg-white mt-4" id="table_personal_data">
                    <tr>
                        <th>Name</th>
                        <th>Number phone</th>
                        <th>Email</th>
                        <th>Living Place</th>
                    </tr>
                    <tr>
                        <td>
                            <input
                                type="text"
                                name="inputs[0][name]"
                                value="{{ old('name') }}"
                                placeholder="enter name"
                                class="form-control"
                            />
                        </td>
                        <td>
                            <input
                                type="text"
                                name="inputs[0][phone]"
                                value="{{ old('phone') }}"
                                placeholder="enter phone"
                                class="form-control"
                            />
                        </td>
                        <td>
                            <input
                                type="text"
                                name="inputs[0][email]"
                                value="{{ old('email') }}"
                                placeholder="enter email"
                                class="form-control"
                            />
                        </td>
                        <td>
                            <input
                                type="text"
                                name="inputs[0][living_place]"
                                value="{{ old('living_place') }}"
                                placeholder="enter living place"
                                class="form-control"
                            />
                        </td>
                    </tr>
                    <div class="col-md-4 mb-3">
                        <label class="bg-white">Upload Images (Max:20 images only)</label>
                        <input type="file" multiple="multiple" name="image[]" class="form-control" />
                    </div>
                </table>

                <div class="p-3 text-zinc-500 text-center">
                    <h1><p class="font-bold">Experience</p></h1>
                </div>
                <table class="table table-bordered bg-white mt-4" id="table_experience">
                    <tr>
                        <th>Date From</th>
                        <th>Date To</th>
                        <th>Position</th>
                        <th>Company</th>
                        <th>Experience</th>
                        <th class="text-center">Add</th>
                    </tr>
                    <tr>
                        <td>
                            <input
                                type="date"
                                name="inputs[0][from]"
                            />
                        </td>
                        <td>
                            <input
                                type="date"
                                name="inputs[0][to]"
                            />
                        </td>
                        <td>
                            <input
                                type="text"
                                name="inputs[0][position]"
                                value="{{ old('position') }}"
                                placeholder="enter position"
                                class="form-control"
                            />
                        </td>
                        <td>
                            <input
                                type="text"
                                name="inputs[0][company]"
                                value="{{ old('company') }}"
                                placeholder="enter company"
                                class="form-control"
                            />
                        </td>
                        <td>
                            <input
                                type="text"
                                name="inputs[0][experience][0]"
                                value="{{ old('experience') }}"
                                placeholder="enter experience"
                                class="form-control"
                            />
                        </td>
                        <td class="text-center">
                            <button type="button" id="add_experience" class="btn btn-success">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </td>
                    </tr>
                </table>
                <div id="experience_section_buttons" class="flex flex-nowrap p-2 col-auto bg-gray-200">
                    <button type="button" id="add_section" class="btn btn-success mr-2 cursor-pointer">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                    <button type="button" id="remove_section" class="btn btn-danger ml-2 cursor-pointer">
                        <i class="fa-solid fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="p-3 text-zinc-500 text-center">
                <h1><p class="font-bold">Rest Information</p></h1>
            </div>
            <div class="col-md-12 pb-3">
                <table class="table table-bordered bg-white mt-3" id="table">
                    <tr>
                       <th>Skill</th>
                       <th>Education</th>
                       <th>Interest</th>
                       <th class="text-center">Add</th>
                    </tr>
                    <tr>
                        <td>
                            <input
                                type="text"
                                name="inputs[0][skill]"
                                value="{{ old('skill') }}"
                                placeholder="enter skill"
                                class="form-control"
                            />
                        </td>
                        <td>
                            <input
                                type="text"
                                name="inputs[0][education]"
                                value="{{ old('education') }}"
                                placeholder="enter education"
                                class="form-control"
                            />
                        </td>
                        <td>
                            <input
                                type="text"
                                name="inputs[0][interest]"
                                value="{{ old('interest') }}"
                                placeholder="enter interest"
                                class="form-control"
                            />
                        </td>
                        <td class="text-center">
                            <button type="button" id="add" class="btn btn-success">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </td>
                    </tr>
                </table>
                <button type="submit" class="btn btn-primary col-md-2">Save</button>
            </div>
        </form>
    </div>
</div>
</x-layout>

<script>
    // add or remove experience field inside experience section

    let i = 0;
    experienceField = (i) => {
        return `<tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>
                <input
                   type="text"
                   name="inputs[`+i+`][experience][]"
                   value="{{ old('experience') }}"
                   placeholder="enter experience"
                   class="form-control"
                />
            </td>
            <td class="text-center">
                <button type="button" id="remove_table_row_experience" class="btn btn-danger">
                   <i class="fa-solid fa-minus"></i>
                </button>
            </td>
        </tr>`;
    }

    $('#add_experience').click(function() {
        $('#table_experience').append(experienceField(i))
    });

    $(document).on('click', '#remove_table_row_experience', function() {
        $(this).parents('tr').remove();
    });

    // add or remove new experience section

    $('#remove_section').hide();
    $(document).on('click', '#add_section', function() {
        if ($('#table_experience tr').length <= 2) {
            $('#remove_section').hide();
        } else {
            $('#remove_section').show();
        }
    });

    $(document).on('click', '#remove_section', function() {
        $('#table_experience tr:eq(2)').remove();
        if ($('#table_experience tr').length <= 2) {
            $('#remove_section').hide();
        } else {
            $('#remove_section').show();
        }
    });

    $('#add_section').click(function() {
       i++;
        $('#table_experience').append(
            `<tr>
                <td>
                    <input
                        type="date"
                        name="inputs[`+i+`][from]"
                    />
                </td>
                <td>
                    <input
                        type="date"
                        name="inputs[`+i+`][to]"
                    />
                </td>
                <td>
                    <input
                        type="text"
                        name="inputs[`+i+`][position]"
                        value="{{ old('position') }}"
                        placeholder="enter position"
                        class="form-control"
                    />
                </td>
                <td>
                    <input
                        type="text"
                        name="inputs[`+i+`][company]"
                        value="{{ old('company') }}"
                        placeholder="enter company"
                        class="form-control"
                    />
                </td>
                <td>
                    <input
                        type="text"
                        name="inputs[`+i+`][experience][]"
                        value="{{ old('experience') }}"
                        placeholder="enter experience"
                        class="form-control"
                    />
                </td>
                <td class="text-center">
                     <button type="button" id="add_experience_next" class="btn btn-success">
                         <i class="fa-solid fa-plus"></i>
                     </button>
                </td>
            </tr>`
        )
    });

    $(document).on('click', '#add_experience_next', function() {
        $('#table_experience').append(experienceField(i))
    });

    // add or remove rest section

    let q = 0;
    $('#add').click(function() {
        ++q;
        $('#table').append(
            `<tr>
                <td>
                    <input
                       type="text"
                       name="inputs[`+q+`][skill]"
                       value="{{ old('skill') }}"
                       placeholder="enter skill"
                       class="form-control"
                    />
                </td>
                <td>
                    <input
                       type="text"
                       name="inputs[`+q+`][education]"
                       value="{{ old('education') }}"
                       placeholder="enter education"
                       class="form-control"
                    />
                </td>
                <td>
                    <input
                        type="text"
                        name="inputs[`+q+`][interest]"
                        value="{{ old('interest') }}"
                        placeholder="enter interest"
                        class="form-control"
                    />
                </td>
                <td class="text-center">
                   <button type="button" id="remove_table_row" class="btn btn-danger">
                      <i class="fa-solid fa-minus"></i>
                   </button>
                </td>
            </tr>`
        )
    });

    $(document).on('click', '#remove_table_row', function() {
        $(this).parents('tr').remove();
    });

</script>
