const userInputBg = document.querySelector('.user-input-bg');
const userInputForm = document.querySelector('.user-input-form');
const userInputBgEdit = document.querySelector('.user-input-bg__edit');
const userInputFormEdit = document.querySelector('.user-input-form__edit');

//USER INPUT POPUP
userInputBg?.addEventListener('click', event => {
  // Check if the clicked element is the user-input form or not
  if (!userInputForm.contains(event.target)) {
    // Close the user-input
    userInputBg.classList.add('hidden');
  }
});

//USER INPUT EDIT POPUP
userInputBgEdit?.addEventListener('click', event => {
  // Check if the clicked element is the user-input form or not
  if (!userInputFormEdit.contains(event.target)) {
    // Close the user-input
    userInputBgEdit.classList.add('hidden');
  }
});

document?.addEventListener('keydown', event => {
  if (event.key === 'Escape') {
    // Close the user-input
    userInputBg?.classList.add('hidden');
    userInputBgEdit?.classList.add('hidden');
  }
});

//SIDEBAR
const btnSidebar = document.querySelector('.btn-sidebar');
const sidebar = document.querySelector('.sidebar');
const sidebarContent = document.querySelector('.sidebar-content-wrapper');
const sidebarFooter = document.querySelector('.user-profile-footer');
const btnLogout = document.querySelector('.btn-user-logout');

btnSidebar?.addEventListener('click', () => {
  // Toggle sidebar class with tailwind
  sidebar.classList.toggle('w-full');
  sidebar.classList.toggle('tablet:w-[30rem]');
  sidebar.classList.toggle('w-14');
  sidebar.classList.toggle('bg-aside');
  //show content
  sidebarContent.classList.toggle('opacity-0');
  //hide logout btn
  btnLogout.classList.toggle('hidden');
  //sidebar footer
  sidebarFooter.classList.toggle('justify-between');
  sidebarFooter.classList.toggle('justify-center');

  // roate btn
  btnSidebar.classList.toggle('fa-flip-horizontal');
  btnSidebar.classList.toggle('btn-aside');
});

// USER PIN

const editBox = document.querySelector('.pin-edit-box');

export const toggleEditBox = (closeBox = false) => {
  const editBoxAll = document.querySelectorAll('.pin-edit-box');
  //to prevent from toggling and simple hide if closeBox
  closeBox
    ? editBoxAll.forEach(box => box.classList.add('hidden'))
    : editBox?.classList.toggle('hidden');
};

const attachEditBtnListener = () => {
  const btnEditPin = document.querySelectorAll('.fa-ellipsis');

  btnEditPin?.forEach(btn => {
    btn.addEventListener('click', e => {
      //find the parent
      const userPin = e.target.closest('.user-pin');
      //find the edit box in the parent
      const editBox = userPin.querySelector('.pin-edit-box');

      // toggle edit box
      if (editBox) {
        console.log(editBox.classList + 'fist');
        editBox.classList.toggle('hidden');
        console.log(editBox.classList + 'second');
      }

      //prevents from bubbling to the parent
      e.stopPropagation();
    });
  });
};

export default attachEditBtnListener;

editBox?.addEventListener('click', e => {
  //prevents from bubbling to the grandparent
  e.stopPropagation();
  //close the box
  e.target.tagName === 'LI' ? toggleEditBox() : null;
});

//close the edit on global click
document.body.addEventListener('click', e => {
  !e.target.classList.contains('.pin-edit-box_item')
    ? toggleEditBox(close)
    : null;
});

//FORM ANIMATION
const inputs = document.querySelectorAll('.input-field');

inputs.forEach(function (input) {
  const label = input.previousElementSibling;
  console.log(input.value);
  let inputHasValue = false;
  // input.addEventListener('focus', function () {
  //   label.classList.add('input-focused');
  // });

  // input.addEventListener('blur', function () {
  //   label.classList.remove('input-focused');
  // });

  input.addEventListener('input', function () {
    if (input.value.trim().length > 0) {
      inputHasValue = true;
      label.classList.add('focused');
    } else {
      // inputHasValue = false;
      label.classList.remove('focused');
    }
  });
});
