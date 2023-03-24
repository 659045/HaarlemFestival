<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <title>Content Management System</title>
</head>

<body>
    <?php
        include __DIR__ . '/../header.php';
        require_once __DIR__ . '/../../controllers/cmsController.php';
        generateHeader('Content Management System', 'dark');
    ?>
    <form method="post" id="editorForm" name="editorForm">
        <div class="mt-[100px]">
            <button type="submit" class="w-[100px] h-[40px] ml-[10px] mb-[10px] text-[#ffffff] font-semibold dark:bg-blue-600 flex items-center justify-center border-2 border-[#29334E] cursor-pointer rounded-md" onclick="back()">Back</button>
            <textarea id="editor" name="editor">
                <?php

                if(isset($_SESSION['EditableHTML'])){
                    echo $_SESSION['EditableHTML'];
                }

                ?>
            </textarea>
            
            <script>
                CKEDITOR.replace( 'editor' );
                CKEDITOR.config.height = 600;
            </script>
            <div class="flex justify-end">
                <button type="submit" class="w-[100px] h-[40px] mr-[50px] mt-[20px] text-[#ffffff] font-semibold dark:bg-blue-600 flex items-center justify-center border-2 border-[#29334E] cursor-pointer rounded-md" onclick="save()">Save</button>
            </div>
        </div>
    </form>
    
    <script>
        window.onbeforeunload = function() {
            return 'All unsaved changes will be lost.  Are you sure you want to leave this page?';
        };
        
        function back() {
            window.location.href = "http://localhost/userPanel";
        }

        function save() {
            var data = CKEDITOR.instances.editor.getData();      
            document.getElementById("editorForm").submit();
        }
    </script>
    <script src="/js/cms/index.js"></script>
</body>