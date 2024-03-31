<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="addForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add New Entry</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="age">Age</label>
                        <input type="number" class="form-control" id="age" name="age" required>
                    </div>
                    <div class="form-group">
                        <label for="fathername">Father Name</label>
                        <select name="fathername" class="form-control" id='fathername'>
                            @foreach (\App\Models\Father::select('id', 'name')->distinct()->get() as $Father)
                                <option value="{{ $Father->id }}">{{ $Father->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="grandfathername">Grandfather Name</label>
                        <select name="grandfathername" class="form-control" id='grandfathername'>
                           
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('script')
    <script>
                $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });
            $(document).ready(function(){
                    $('#fathername').change(function(){
                        var fathers_id = $(this).val();
                        $.ajax({
                            url: '{{ route('grand.get', ['id'=> ':id']) }}'.replace(':id', fathers_id),
                            type: 'POST',
                            dataType: 'json',
                            success: function(response){
                                console.log(response.grandFather.name);
                                $("#grandfathername").find('option').remove();
                                if(response.grandFather.name){
                                    $("#grandfathername").append("<option value='" + response.grandFather.id + "'>" + response.grandFather.name + "</option>");
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('Error:', error);
                            }
                        });
                    });
            }); 
    </script>                
@endpush
