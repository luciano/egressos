$(document).ready( () => {
    $('#search-user').click((e) => {
        e.preventDefault();

        const course = $("select[name=course] option:selected").val();
        const typ = $("select[name=typ] option:selected").val();
        const year = $("select[name=year] option:selected").val();
        const url = e.currentTarget.getAttribute('href');
        
        $.ajax({
            type: 'POST',
            url: url, 
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
            },
            data: {'course': course, 'typ': typ, 'year': year},
            success: (result) => {
                $(".info-user").html(result);
            }
        });
    });
});