<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="editForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Entry</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type='hidden' name="edit_id" id="edit_id">
                    
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="edit_name" name="edit_name" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="edit_email" name="edit_email" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_age" class="form-label">Age</label>
                        <input type="number" class="form-control" id="edit_age" name="edit_age" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_fathername" class="form-label">Father Name</label>
                        <select name="edit_fathername" class="form-control" id="edit_fathername">
                            @foreach (\App\Models\Father::select('id', 'name')->distinct()->get() as $Father)
                                <option value="{{ $Father->id }}">{{ $Father->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_grandfathername"  class="form-label">Grandfather Name</label>
                        <select name="edit_grandfathername" class="form-control" id="edit_grandfathername">
                             <option value=""></option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
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
                $('#edit_fathername').change(function(){
                        var fathers_id = $(this).val();
                        console.log(fathers_id)
                        $.ajax({
                            url: '{{ route('grand.get', ['id'=> ':id']) }}'.replace(':id', fathers_id),
                            type: 'POST',
                            dataType: 'json',
                            success: function(response){
                                console.log(response.grandFather.name);
                                $("#edit_grandfathername").find('option').remove();
                                if(response.grandFather.name){
                                    $("#edit_grandfathername").append("<option value='" + response.grandFather.id + "'>" + response.grandFather.name + "</option>");
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('Error:', error);
                            }
                        });
                    });
                    $('#editModal').on('shown.bs.modal', function() {
                $('#edit_fathername').change();
            });
            }); 
    </script>                
@endpush

