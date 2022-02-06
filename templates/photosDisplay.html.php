<div class="rightBox">
    <div class="mt-3">
        <h2>photos</h2>
    </div>
    <div class="d-flex justify-content-between actionIcons">
        <div class="d-flex align-items-center">
            <div class="actionIcon1" id="actionIcon1">
                <img src="/img/rOne@4x.png" alt="">
                <div class="actionName actionName1">upload</div>
                <div class="upload align-items-center justify-content-center" id="upload">
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="file" name="file" id="file" multiple="multiple">
                        <div class="btn" id="uploadImages">upload</div>
                    </form>
                </div>
            </div>
            <div class="actionIcon2" id="actionIcon2">
                <img src="/img/rTwo@4x.png" alt="">
                <div class="actionName actionName2">add folder</div>
                <div class="upload align-items-center justify-content-center" id="addFolder">
                    <input type="text" placeholder="folder name..." id="folderName">
                    <button id="addFolder">add folder</button>
                </div>
            </div>
            <div class="actionIcon3" id="actionIcon3">
                <img src="/img/rThree@4x.png" alt="">
                <div class="actionName actionName3">insert</div>
                <div class="upload align-items-center justify-content-center" id="insertImage">
                    <select id="displayForFolders">

                    </select>
                    <button id="insertIntoFolder">insert image</button>
                </div>
            </div>
            <div class="actionIcon4" id="actionIcon4">
                <img src="/img/rFour@4x.png" alt="">
                <div class="actionName actionName4">delete</div>
            </div>
        </div>
        <div class="d-flex">
            <button id="sortName">name</button>
            <button id="sortSize">size</button>
            <button id="sortDate">upload</button>

        </div>
    </div>
    <div id="foldersPathDisplay">

    </div>

    <div class="photoDiv" id="pathDiv">
    </div>

    <div class="photoDiv row" id="folderDiv"></div>

    <div class="photoDiv row" id="photoDiv"></div>
</div>

<script type="module" src="js/index.js">

</script>
