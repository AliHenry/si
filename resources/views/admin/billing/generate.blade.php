@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/users/users.js"></script>
@stop

@section('content')
    <generate-bill/>
@stop
<script>
    import GenerateBill from "../../../admin/js/components/GenerateBill";
    export default {
        components: {GenerateBill}
    }
</script>