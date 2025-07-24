$('select[name="performances[parameter_id]"]').change(function(){
    // load indikator
    const id = $(this).val()
    fetch('/assessment/target-indicators/get?filter[parameter_id]=' + id)
        .then(res => res.json())
        .then(res => {
            const target = 'select[name="performances[indicator_id]"]'
            $(target).empty().append('<option value="">- Pilih Parameter -</option>');
            res.data.forEach(function(item) {
                $(target).append('<option value="' + item.id + '">' + item.description + '</option>');
            });
        })
})