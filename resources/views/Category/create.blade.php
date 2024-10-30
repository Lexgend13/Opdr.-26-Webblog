@error('categories')
    <a class='red'>You must pick as least one category</a><br>
    <a class='red'>If categories displayed are not suitable, please opt to add a new one</a>
    <br>
@enderror
<button id='showCategoryAddOn'>Create Category</button>
<br>
<br>
<div id='enabled' style="display: none;">
    
    <form id="category_form" method="POST" action="{{route('categories.store')}}">
        @csrf
        <div class="form-group">
        <label for="name"></label>
        <input  type="text" 
            id="name" 
            name="name"
            placeholder="Name"  
            required>
        </div>
        <button type="submit">Add new Category</button>
    </form>
    <a class="warning">Beware that adding a category refreshes the page, undoing unsubmitted progress</a>
    <br><br>
</div>
@error('name')
    <a class='red'>Category already exists</a>
@enderror
<label>Upload image</label><br>
<input type="file" name="fileToUpload" id="fileToUpload" form="main_form">
<br>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var showCategoryAddOn = document.getElementById('showCategoryAddOn');
    var enabled = document.getElementById('enabled');

    showCategoryAddOn.addEventListener('click', function() {
        enabled.style.display = enabled.style.display === 'none' ? 'block' : 'none';
    });
});
</script>