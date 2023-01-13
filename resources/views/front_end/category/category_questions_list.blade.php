@extends("front_end/layout/main")
@section("content")
    @php
        $questionRecord =  $pageData["question-record"];
        $limit = isset($_GET["limit"]) && !empty($_GET["limit"]) ? $_GET["limit"] : "10";
        $sort = isset($_GET["sort"]) && !empty($_GET["sort"]) ? $_GET["sort"] : "newest";
        $sortDirection = isset($_GET["sort_dir"]) && !empty($_GET["sort_dir"]) ? $_GET["sort_dir"] : "";
        $tags = isset($_GET["tag"]) && !empty($_GET["tag"]) ? $_GET["tag"] : "";
        $id = request()->id;
    @endphp

    <script>
        jQuery("document").ready(function () {
            jQuery("#sort").change(function () {
                var valueOfLimit = jQuery(" #sort option:selected").text();
                var sortValueChange = jQuery("#sort_value").val(valueOfLimit);
                if (sortValueChange) {
                    formSubmit();
                }
            });
            jQuery("#limit").change(function () {
                var valueOfSort = jQuery(" #limit option:selected").text();
                var limitValueChange = jQuery("#limit_value").val(valueOfSort);
                if (limitValueChange) {
                    formSubmit();
                }
            });
            jQuery(".del_ete").on('click', function (e) {
                e.preventDefault();
                var path = jQuery(this).attr('href');
                console.log(path);
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = path;
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            });
        });

        function formSubmit() {
            jQuery("#filter").submit();
        }

        var maxLength = 180;
        jQuery(".readmore").each(function () {
            var str = jQuery(this).text();

            if (jQuery.trim(str).length > maxLength) {
                var nstr = str.substring(0, maxLength);
                var rmstr = str.substring(maxLength, $.trim(str).length);
                jQuery(this).empty().html(nstr);
                jQuery(this).append('<a href = "javascript:void(0);" class="readmore"> read more... </a>');
                jQuery(this).append('<span class = "moretext">' + rmstr + '</span> ');
            }
        });
        jQuery(".readmore").click(function () {
            jQuery(this).siblings(".moretext").contents().unwrap();
            //  jQuery(this).remove();
        });

    </script>


@endsection