<template>
    <div>

        <div class="form-group">
            <label for="txtName">Name</label>
            <input v-model="data" style="width: 300px" type="text" class="form-control" id="txtName" aria-describedby="nameHelp" placeholder="Name">
            <small id="nameHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <button @click.prevent.stop="save" class="btn btn-primary">Save</button>
        </div>

    </div>
</template>

<script>
    export default {
        name: "AddClient"
    }
</script>

<style scoped>

</style>
