<template>
    <div @click.prevent.stop="showAutoCompleteWrapper(true)" class="auto-complete">
        <div class="auto-complete-display form-control" style="cursor: pointer"></div>
        <div class="auto-complete-wrapper">
            <input @keyup="filterAutoCompleteResultList" type="text" class="auto-complete-input-field" placeholder="Type anything here">
            <ul class="auto-complete-result-container">
                <li @click.prevent.stop="selectItem(item)" v-for="item in filteredData" class="auto-complete-result-item">{{item.name}}</li>
            </ul>
        </div>

    </div>
</template>

<script>
    export default {
        props: ['data', 'selectedText', 'selectedValue'],
        data(){
            return{
                filtered: [],
                isAutoCompleteWrapperVisible: false,
            }
        },
        mounted(){
            this.setDefaultSelectedValue();

            document.addEventListener('click', this.handleClickOutside);
        },
        destroyed(){
            document.removeEventListener('click', this.handleClickOutside);
        },
        methods:{
            handleClickOutside(evt) {
                if (!this.$el.contains(evt.target)) {
                    this.showAutoCompleteWrapper(false);
                }
            },
            setDefaultSelectedValue(){
                if(this.data){
                    if(this.data.length > 0){
                        const item = this.data[0];

                        this.$emit('input', item[this.selectedValue]);//pass data to component

                        //display selected name
                        const autoComplete = document.querySelector('.auto-complete-display');
                        autoComplete.innerText = item[this.selectedText];
                    }
                }
            },
            selectItem(item){
                if(this.selectedValue && this.selectedText){
                    this.$emit('input', item[this.selectedValue]);//pass data to component

                    //display selected name
                    const autoComplete = document.querySelector('.auto-complete-display');
                    autoComplete.innerText = item[this.selectedText];

                    //invisible auto complete modal
                    this.showAutoCompleteWrapper(false);
                }
            },
            showAutoCompleteWrapper(isShowing){
                if(this.selectedValue && this.selectedText) {
                    const autoCompleteWrapper = document.querySelector('.auto-complete-wrapper');
                    if (isShowing) {
                        autoCompleteWrapper.classList.add('visible');
                        if (this.data) {
                            if (this.data.length > 0) {
                                this.showAutoCompleteResultContainer(true);
                            }
                        }
                        this.isAutoCompleteWrapperVisible = false;
                    } else {
                        autoCompleteWrapper.classList.remove('visible');
                        this.showAutoCompleteResultContainer(false);
                        this.isAutoCompleteWrapperVisible = true;
                    }
                }
            },
            filterAutoCompleteResultList(e){
                const keyWord = (e.target.value).toLowerCase();
                if(this.data){
                    if(this.data.length > 0){
                        let result = this.data.filter(r => (r[this.selectedText]).toLowerCase().includes(keyWord));
                        if(result.length > 0){
                            this.filtered = result;
                            this.showAutoCompleteResultContainer(true);
                        }
                        else{
                            this.filtered = this.data;
                        }
                    }
                }
            },
            showAutoCompleteResultContainer(isShow){
                const autoCompleteResultContainer = document.querySelector('.auto-complete-result-container');
                if(isShow){
                    autoCompleteResultContainer.classList.add('visible');
                }
            }
        },
        computed:{
            filteredData(){
                if(this.filtered.length > 0){
                    return this.filtered;
                }
                else{
                    return this.data;
                }
            }
        }
    }
</script>

<style scoped>
    .auto-complete{
        width: 300px;
        position: relative;
    }
    .auto-complete-wrapper{
        margin-top: 3px;
        border: 1px solid gray;
        border-radius: 5px;
        background-color: #fff;
        width: 100%;
        overflow: hidden;
        display: none;
        position: absolute;
    }
    .auto-complete-wrapper.visible{
        display: block;
    }
    .auto-complete-result-container{
        max-height: 200px;
        width: 100%;
        padding: 10px;
        margin: 0;
        list-style: none;
        overflow: auto;
        display: none;
    }
    .auto-complete-result-container.visible{
        display: block;
    }
    .auto-complete-input-field{
        outline: none;
        border: none;
        width: 100%;
        font-size: 16px;
        padding: 10px 12px;
    }
    .auto-complete-result-item{
        padding: 10px;
        cursor: pointer;
        border-bottom: 1px solid gray;
        transition: 0.3s ease;
        -webkit-transition: 0.3s ease;
        -o-transition: 0.3s ease;
        -moz-transition: 0.3s ease;
    }
    .auto-complete-result-item:hover{
        background-color: #f7c6c5;
        border-color: transparent;
        border-radius: 5px;
    }
</style>
