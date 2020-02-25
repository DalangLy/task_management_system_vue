<template>
    <div @click.prevent.stop="showAutoCompleteWrapper(true)" class="auto-complete">
        <div ref="autoCompleteDisplayRef" class="auto-complete-display" style="cursor: pointer">hello</div>
        <div ref="autoCompleteWrapperRef" class="auto-complete-wrapper">
            <input ref="autoCompleteInputRef" @keyup="filterAutoCompleteResultList" type="text" class="auto-complete-input-field" placeholder="Type anything here">
            <ul ref="autoCompleteResultContainerRef" class="auto-complete-result-container">
                <li @click.prevent.stop="selectItem(item)" v-for="item in filteredData" class="auto-complete-result-item">{{item[selectedText]}}</li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AutoCompleteSelection",
        props: ['data', 'selectedText', 'selectedValue', 'selectedItemId'],
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
                evt.stopPropagation();
                //evt.preventDefault();
                if (!this.$el.contains(evt.target)) {
                    this.showAutoCompleteWrapper(false);
                }
            },
            setDefaultSelectedValue(){
                const autoComplete = this.$refs.autoCompleteDisplayRef;

                if(this.data){
                    if(this.data.length > 0){

                        //if no selected item then select the first one
                        let item = this.data[0];
                        //if selected item existed then select the selected item value
                        if(this.selectedItemId){
                            const foundItem = this.data.findIndex(r => parseInt(r[this.selectedValue]) === parseInt(this.selectedItemId));
                            if(foundItem >= 0){
                                item = this.data[foundItem];
                            }else{
                                console.log("can't find id");
                            }
                        }

                        this.$emit('input', item[this.selectedValue]);//pass data to component
                        //display selected name
                        autoComplete.innerText = item[this.selectedText];
                    }
                    else{
                        //console.log('no value');
                        //remove selected name from auto complete
                        autoComplete.innerText = '';
                    }
                }
            },
            selectItem(item){
                if(this.selectedValue && this.selectedText){
                    this.$emit('input', item[this.selectedValue]);//pass data to component

                    //display selected name
                    const autoComplete = this.$refs.autoCompleteDisplayRef;
                    autoComplete.innerText = item[this.selectedText];

                    //invisible auto complete modal
                    this.showAutoCompleteWrapper(false);
                }
            },
            showAutoCompleteWrapper(isShowing){

                this.closeOtherOpeningAutoComplete();

                if(this.selectedValue && this.selectedText) {
                    const autoCompleteWrapper = this.$refs.autoCompleteWrapperRef;
                    if (isShowing) {
                        autoCompleteWrapper.classList.add('visible');
                        //focus search input
                        this.$refs.autoCompleteInputRef.focus();
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
            closeOtherOpeningAutoComplete(){
                //close other opening auto complete
                //protect if you use this auto complete more than one in a page, so when you open other so so the last one wont close
                const otherAutoComplete = document.querySelectorAll('.auto-complete-wrapper');
                otherAutoComplete.forEach(autoComplete => {
                    autoComplete.classList.remove('visible');
                    this.showAutoCompleteResultContainer(false);
                });
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
                const autoCompleteResultContainer = this.$refs.autoCompleteResultContainerRef;
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
        },
        watch:{
            data: function (val) {
                //check if data is change so selected default value to auto complete
                this.setDefaultSelectedValue();
            },
            selectedItemId: function(val){
                this.setDefaultSelectedValue();
            }
        }
    }
</script>

<style scoped>
    .auto-complete-display{

    }
    .auto-complete{
        width: 100%;
        height: 100%;
        position: relative;
        user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
        -moz-user-select: none;
    }
    .auto-complete-wrapper{
        margin-top: 3px;
        border: 1px solid #ced4da;
        border-radius: 5px;
        background-color: #fff;
        width: 100%;
        overflow: hidden;
        display: none;
        position: absolute;
        z-index: 100;
        -webkit-box-shadow: 3px 3px 13px 0px rgba(0,0,0,0.35);
        -moz-box-shadow: 3px 3px 13px 0px rgba(0,0,0,0.35);
        box-shadow: 3px 3px 13px 0px rgba(0,0,0,0.35);
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
        border-bottom: 1px solid #ced4da;
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
