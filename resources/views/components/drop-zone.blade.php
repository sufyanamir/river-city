<div  id="dropzonee" class="dropzonee border rounded-xl">    
    <img id="profileImage" src="{{ 'assets/images/rectangle-image.svg' }}"  style="width: 100%; height: 237px; object-fit: fill;" alt="IMAGE">
    <div class="file-inputt-container">
        <input class="file-input" type="file" name="{{ $name }}" id="fileInput1">
        <div class="upload-iconn" onclick="document.getElementById('fileInput1').click()">
            <img src="{{ asset('assets/images/upload-image.svg') }}" alt="Image">
        </div>
    </div>
</div>
<p class="error-image text-red-700 d-none" style="font-size: smaller;"></P>