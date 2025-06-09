
        document.addEventListener('DOMContentLoaded', function() {
            // Cria elemento para o tooltip para funcionar melhor em mobile
            const tooltip = document.getElementById('tooltip');
            
            // Anima elementos na carga da página
            const elementsToAnimate = [
                '.main-content', '.features', '.trust-badge', '.btn',
                '.benefit-item', '.feature'
            ];
            
            elementsToAnimate.forEach(selector => {
                const elements = document.querySelectorAll(selector);
                elements.forEach((el, index) => {
                    el.style.opacity = "0";
                    el.style.transform = "translateY(20px)";
                    
                    setTimeout(() => {
                        el.style.transition = "all 0.6s ease";
                        el.style.opacity = "1";
                        el.style.transform = "translateY(0)";
                    }, 200 + (index * 100));
                });
            });
            
            // Adiciona efeito de destaque ao botão principal após alguns segundos
            setTimeout(() => {
                const btnEntrar = document.getElementById('btn-entrar');
                btnEntrar.classList.add('highlight-pulse');
            }, 2000);
            
            // Melhora interatividade dos botões
            const buttons = document.querySelectorAll('.btn');
            buttons.forEach(btn => {
                btn.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                });
                
                btn.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
                
                btn.addEventListener('click', function() {
                    this.style.transform = 'scale(0.98)';
                    setTimeout(() => {
                        this.style.transform = 'scale(1)';
                    }, 100);
                });
            });
            
            // Demonstração interativa nas funcionalidades
            const features = document.querySelectorAll('.feature');
            
            // Funcionalidade para tooltips
            features.forEach(feature => {
                feature.addEventListener('mouseenter', showTooltip);
                feature.addEventListener('touchstart', showTooltip);
                
                feature.addEventListener('mouseleave', hideTooltip);
                feature.addEventListener('touchend', hideTooltip);
                
                feature.addEventListener('click', function() {
                    // Simula seleção
                    features.forEach(f => f.style.backgroundColor = '');
                    this.style.backgroundColor = 'var(--primary-very-light)';
                });
            });
            
            function showTooltip(e) {
                const feature = e.currentTarget;
                const tooltipText = feature.getAttribute('data-tooltip');
                
                if (tooltipText) {
                    tooltip.textContent = tooltipText;
                    tooltip.style.opacity = '1';
                    
                    // Posiciona o tooltip acima do elemento
                    const rect = feature.getBoundingClientRect();
                    tooltip.style.top = (rect.top - tooltip.offsetHeight - 10) + 'px';
                    tooltip.style.left = (rect.left + rect.width/2 - tooltip.offsetWidth/2) + 'px';
                    
                    // Ajusta se estiver fora da tela
                    const tooltipRect = tooltip.getBoundingClientRect();
                    if (tooltipRect.left < 10) {
                        tooltip.style.left = '10px';
                    } else if (tooltipRect.right > window.innerWidth - 10) {
                        tooltip.style.left = (window.innerWidth - tooltipRect.width - 10) + 'px';
                    }
                    
                    if (tooltipRect.top < 10) {
                        // Se não couber em cima, coloca embaixo
                        tooltip.style.top = (rect.bottom + 10) + 'px';
                    }
                }
                
                this.style.transform = 'translateY(-5px)';
            }
            
            function hideTooltip() {
                tooltip.style.opacity = '0';
                this.style.transform = 'translateY(0)';
            }
            
            // Ajusta layout em caso de redimensionamento
            window.addEventListener('resize', function() {
                // Esconde tooltip ao redimensionar
                tooltip.style.opacity = '0';
                
                // Ajusta a posição se algum estiver visível
                const activeFeature = document.querySelector('.feature:hover');
                if (activeFeature) {
                    setTimeout(() => {
                        showTooltip.call(activeFeature, {currentTarget: activeFeature});
                    }, 100);
                }
            });
        });