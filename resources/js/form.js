export async function handleFormSubmit(e, success, fail) {
    const form = e.target;
    const submitBtn = form.querySelector('button[type="submit"]');

    submitBtn.disabled = true;
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = `<span class="spinner-border spinner-border-sm" role="status"></span>Processing... `;

    try {
        const response = await fetch(form.action, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: new FormData(form)
        });

        if (!response.ok) {
            throw new Error(await response.text());
        }

        const data = await response.json();
        showToast(data.message || success);
        form.reset();
    } catch (error) {
        const jsonStart = error.message.indexOf('{');
        const jsonEnd = error.message.lastIndexOf('}') + 1;
        const jsonString = error.message.slice(jsonStart, jsonEnd);

        const errorDetails = JSON.parse(jsonString);

        console.error('Submission error:', error);
        showToast(errorDetails.message || fail);
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
    }

    return false;
}

export function showToast(message) {
    const toastEl = document.getElementById('liveToast');
    if (!toastEl) return;

    const toast = new bootstrap.Toast(toastEl);
    const toastBody = toastEl.querySelector('.toast-body');

    toastBody.textContent = message;
    toast.show();
}

// export {handleFormSubmit, showToast};