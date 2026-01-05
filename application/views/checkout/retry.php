<script>
    window.snap.pay("<?= $snapToken ?>", {
        onSuccess: () => location.href = "<?= site_url('checkout/success') ?>",
        onPending: () => location.href = "<?= site_url('checkout/pending') ?>",
        onError: () => location.href = "<?= site_url('checkout/error') ?>"
    });
</script>