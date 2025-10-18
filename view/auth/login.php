<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$login_feedback = $_SESSION['login_feedback'] ?? null;
if ($login_feedback) {
    $error = $login_feedback['error'] ?? '';
    $fieldErrors = $login_feedback['fieldErrors'] ?? ['nim' => false, 'password' => false];
    $old = $login_feedback['old'] ?? [];
    $shake = $login_feedback['shake'] ?? false;
    unset($_SESSION['login_feedback']);
} else {
    $error = $error ?? '';
    $fieldErrors = $fieldErrors ?? ['nim' => false, 'password' => false];
    $old = $old ?? [];
    $shake = $shake ?? false;
}

?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Media Belajar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Shake animation for invalid submits */
        @keyframes shake {
            0% {
                transform: translateX(0);
            }

            20% {
                transform: translateX(-8px);
            }

            40% {
                transform: translateX(8px);
            }

            60% {
                transform: translateX(-6px);
            }

            80% {
                transform: translateX(6px);
            }

            100% {
                transform: translateX(0);
            }
        }

        .shake {
            animation: shake 0.45s ease-in-out;
        }
    </style>
</head>

<body class="bg-[#1e203b] text-white">

    <div class="relative min-h-screen flex items-center justify-center overflow-hidden">
        <div class="absolute w-96 h-96 bg-[#3b3e6e] rounded-full -top-20 -left-20 opacity-30 blur-3xl"></div>
        <div class="absolute w-96 h-96 bg-[#4c3e6d] rounded-full -bottom-20 -right-20 opacity-30 blur-3xl"></div>
        <div class="absolute w-72 h-72 bg-[#2a496b] rounded-full bottom-20 -left-10 opacity-20 blur-3xl"></div>

        <div class="absolute top-1/4 left-1/4 text-2xl text-white/50 transform rotate-45">+</div>
        <div class="absolute top-10 right-1/4 text-2xl text-white/50 transform rotate-45">+</div>
        <div class="absolute bottom-1/4 right-1/4 text-lg text-white/50 transform rotate-12">+</div>
        <div class="absolute bottom-1/2 left-1/3 text-lg text-white/50 transform -rotate-12">+</div>
        <div class="absolute top-1/2 right-1/3 text-xl text-white/50 transform rotate-45">+</div>


        <div class="relative z-10 w-full max-w-sm px-4">
            <?php
            if (!isset($fieldErrors))
                $fieldErrors = ['nim' => false, 'password' => false];
            if (!isset($shake))
                $shake = false;
            if (!isset($error))
                $error = '';
            ?>
            <div id="login-card" class="bg-[#2a2c4e] p-8 rounded-2xl shadow-lg <?php echo $shake ? 'shake' : ''; ?>">
                <div class="text-center mb-10">
                    <h1 class="text-3xl font-bold">Media Belajar</h1>
                </div>

                <?php if (isset($success_message)): ?>
                    <div
                        style="padding: 15px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 5px; margin-bottom: 15px;">
                        <?php echo htmlspecialchars($success_message); ?>
                    </div>
                <?php endif; ?>
                <?php if (isset($error)): ?>
                    <p style="color:red;"><?php echo $error; ?></p>
                <?php endif; ?>

                <form id="login-form" action="index.php?action=doLogin" method="POST" novalidate>
                    <div class="mb-5">
                        <label for="nim" class="block text-xs font-medium text-gray-400 mb-2">NIM</label>
                        <input id="nim" type="text" placeholder="NIM" name="nim"
                            value="<?php echo htmlspecialchars($old['nim'] ?? ''); ?>"
                            class="w-full bg-[#1e203b] rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 <?php echo $fieldErrors['nim'] ? 'border-red-500 ring-1 ring-red-500' : 'border-transparent'; ?>">
                    </div>

                    <div class="mb-8">
                        <label for="password" class="block text-xs font-medium text-gray-400 mb-2">PASSWORD</label>
                        <input id="password" type="password" placeholder="PASSWORD" name="password"
                            class="w-full bg-[#1e203b] rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 <?php echo $fieldErrors['password'] ? 'border-red-500 ring-1 ring-red-500' : 'border-transparent'; ?>">
                    </div>

                    <?php if ($error): ?>
                        <div id="server-error" class="text-sm text-red-300 mb-4"><?php echo htmlspecialchars($error); ?>
                        </div>
                    <?php endif; ?>

                    <button type="submit"
                        class="w-full bg-white text-black font-bold py-3 px-4 rounded-full flex items-center justify-center hover:bg-gray-200 transition-colors">
                        LOG IN
                        <span
                            class="ml-2 bg-blue-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">
                            &#10003;
                        </span>
                    </button>
                </form>
                <p class="text-center text-gray-600 text-sm mt-6">
                    Belum punya akun?
                    <a href="index.php?action=register" class="font-bold text-violet-600 hover:text-violet-800">
                        Daftar di sini
                    </a>
                </p>
            </div>

            <div class="text-center mt-6">
                <a href="#" class="text-xs font-medium text-gray-400 hover:underline">
                    FORGOT YOUR PASSWORD?
                </a>
            </div>
        </div>
    </div>

    <script>
        (function () {
            const form = document.getElementById('login-form');
            const nim = document.getElementById('nim');
            const password = document.getElementById('password');
            const card = document.getElementById('login-card');

            function markError(el) {
                el.classList.add('border-red-500', 'ring-1', 'ring-red-500');
            }
            function clearError(el) {
                el.classList.remove('border-red-500', 'ring-1', 'ring-red-500');
            }

            form.addEventListener('submit', function (e) {
                let hasError = false;
                if (!nim.value.trim()) {
                    markError(nim);
                    hasError = true;
                } else { clearError(nim); }

                if (!password.value) {
                    markError(password);
                    hasError = true;
                } else { clearError(password); }

                if (hasError) {
                    e.preventDefault();
                    card.classList.remove('shake');
                    // reflow to restart animation
                    void card.offsetWidth;
                    card.classList.add('shake');
                }
            });

            // If server returned an error, trigger a visual shake on load
            document.addEventListener('DOMContentLoaded', function () {
                const serverError = document.getElementById('server-error');
                if (serverError) {
                    card.classList.remove('shake');
                    void card.offsetWidth;
                    card.classList.add('shake');
                }
            });
        })();
    </script>
</body>

</html>