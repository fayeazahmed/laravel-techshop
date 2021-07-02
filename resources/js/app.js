require('./bootstrap');

require('alpinejs');

// Submit search request
const navInput = document.querySelector("nav input")
navInput.addEventListener("keyup", e => {
  const query = navInput.value
  if(e.keyCode === 13 && query !== "")
    window.location.href = `/products/search/${query}`
})

// Submit user delete request
const deleteBtn = document.querySelector(".admin__details .deleteBtn #delete-btn");
const deletePanel = document.querySelector(".admin__details .deletePanel");
const cancelBtn = deletePanel?.querySelectorAll("button")[1]
deleteBtn?.addEventListener("click", e => {
  deletePanel.style.display = "block"
})
cancelBtn?.addEventListener("click", e => {
  deletePanel.style.display = "none"
})

// Modify category
const categoryDiv = document.querySelector(".admin__items--category")
const categoryBtns = categoryDiv?.querySelectorAll(".buttons")
categoryBtns?.forEach(div => {
  const editBtn = div.querySelectorAll("button")[0]
  const dltBtn = div.querySelectorAll("button")[1]

  editBtn?.addEventListener("click", e => {
    const cInput = e.currentTarget.parentNode.previousElementSibling
    cInput.disabled = cInput.disabled ? false : true
  })
  dltBtn?.addEventListener("click", e => {
    const form = e.currentTarget.parentNode.parentNode
    form.querySelector("input[name='_method']").value = "delete"
    form.submit()
  })
})

// Filter product
const filterForm = document.querySelector(".product-filter-form")
if(filterForm) {
  const category_id = filterForm.querySelector("select")
  category_id.addEventListener("change", () => filterForm.submit())
}

// Modify product
const editButton = document.querySelector(".admin__details .deleteBtn #edit-btn");
editButton?.addEventListener("click", e => {
    const inputList = e.currentTarget.parentNode.parentNode.querySelector(".edit-product").querySelectorAll(".toggle-input")
    inputList.forEach(input => {
      input.disabled = input.disabled ? false : true
    })
})

// Filter location
const locationSelect = document.querySelector(".location-filter-form")
if(locationSelect) {
  const location = locationSelect.querySelector("select")
  location.addEventListener("change", () => locationSelect.submit())
}

// Burger menus
let MENU_OPEN = false
let CATEGORY_OPEN = false
const menuBtns = document.querySelectorAll(".burger-menus button") 
const links = document.querySelector(".links")
const categories = document.querySelector(".categories")
if(menuBtns) {
  menuBtns[0].addEventListener("click", () => {
    categories.style.transform = CATEGORY_OPEN ? "translateX(-100%)" : "translateX(0)"
    CATEGORY_OPEN = !CATEGORY_OPEN
  })

  menuBtns[1].addEventListener("click", () => {
    links.style.display = MENU_OPEN ? "none" : "flex"
    MENU_OPEN = !MENU_OPEN
  })
}