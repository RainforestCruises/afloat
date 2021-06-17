@media only screen and (max-width: $bp-large) {
                display: none;       
            }

            &__inputs {
                display: flex;
                margin-bottom: 4rem;

   

                &__form-group {
                    display: grid;
                    align-content: center;

                    grid-template-columns: min-content 1fr;
                    column-gap: 1rem;
                    width: 40rem;
                    width: min-content;

                    margin-right: 3rem;
                    @media only screen and (max-width: $bp-small) {
                        grid-template-columns: 1fr;
                    }

                    &__icon {
                        display: flex;
                        align-items: center;
                        transform: translateY(-1.2rem);
                        & svg {
                            color: $color-gold;
                            stroke-width: 3;
                            height: 4.5rem;
                            width: 4.5rem;
                        }

                        @media only screen and (max-width: $bp-small) {
                            display: none;
                        }
                    }

                    &__input-group {
                        display: flex;
                        flex-direction: column;
                        align-self: center;
                        position: relative;
                        width: min-content;

                        &__label {
                            position: absolute;
                            top: -2rem;
                            left: 0;
                            letter-spacing: 0.3rem;
                            font-size: 1.5rem;
                            text-transform: uppercase;
                            font-weight: 600;
                            color: $color-white;
                            margin-left: 1rem;
                            transition: opacity 0.2s;
                            white-space: nowrap;
                            &.open {
                                opacity: 0;
                            }
                        }
                    }
                }
            }

            &__cta {
                display: flex;

                @media only screen and (max-width: $bp-large) {
                    grid-column: 1 / -1;
                }

                &__button {
                    background-color: transparent;
                    border: 2px solid $color-gold;
                    text-transform: uppercase;
                    font-family: $font-primary;
                    color: $color-white;
                    white-space: nowrap;
                    font-size: 1.5rem;
                    letter-spacing: 0.3rem;
                    font-weight: 500;

                    cursor: pointer;
                    height: 5rem;
                    width: 14rem;
                    outline: none;
                    transition: all 0.2s;

                    display: flex;
                    justify-content: center;
                    align-items: center;
                    //padding: 0 4rem;

                    & .lds-ring {
                        display: none;
                    }

                    &:hover {
                        background-color: rgba($color-gold, 0.95);
                        color: rgba($color-black, 1);
                        font-weight: 600;
                    }

                    &.loading {
                        background-color: rgba($color-gold, 0.95);
                        cursor: default;
                        & span {
                            display: none;
                        }
                        & .lds-ring {
                            display: inline-block;
                        }
                        //
                    }
                }
            }